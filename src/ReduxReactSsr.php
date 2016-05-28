<?php
/**
 * This file is part of the Koriym\ReduxReactSsr package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\ReduxReactSsr;

use Koriym\ReduxReactSsr\Exception\RootContainerNotFound;
use V8Js;

final class ReduxReactSsr implements ReduxSsrInterface
{
    /*
     * @var V8Js
     */
    private $v8;

    /**
     * @var string
     */
    private $reactBundleSrc;

    /**
     * @var string
     */
    private $appBundleSrc;

    /**
     * @param string $reactBundleSrc Bundled code include React, ReactDom, and Redux
     * @param string $appBundleSrc   Bundled application code
     */
    public function __construct(string $reactBundleSrc, string $appBundleSrc)
    {
        $this->v8 = new V8Js();
        $this->reactBundleSrc = $reactBundleSrc;
        $this->appBundleSrc = $appBundleSrc;
        $this->v8->error = function ($container) {
            throw new RootContainerNotFound($container);
        };
    }

    public function __invoke(string $rootContainer, array $store)
    {
        $storeJson = json_encode($store);
        $code = <<< "EOT"
var console = {warn: function(){}, error: print};
var global = global || this, self = self || this, window = window || this;
var document = typeof document === 'undefined' ? '' : document;
{$this->reactBundleSrc}
var React = global.React, ReactDOM = global.ReactDOM, ReactDOMServer = global.ReactDOMServer;
{$this->appBundleSrc}
var Provider = global.Provider, configureStore = global.configureStore, App = global.{$rootContainer};
if (! App) { PHP.error('{$rootContainer}'); };
var store = configureStore({$storeJson});
App = React.createElement(App);
var html = ReactDOMServer.renderToString(React.createElement(Provider, { store: store }, App));
var state = JSON.stringify(store.getState());
tmp = {html: html, js: '<script>window.__PRELOADED_STATE__ = ' + state + ';</script>'};
EOT;
        $v8 = $this->v8->executeString($code);

        return [$v8->html, $v8->js . PHP_EOL];
    }
}
