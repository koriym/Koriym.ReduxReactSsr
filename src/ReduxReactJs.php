<?php
/**
 * This file is part of the Koriym\ReduxReactSsr package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\ReduxReactSsr;

use Koriym\ReduxReactSsr\Exception\RootContainerNotFound;
use V8Js;

final class ReduxReactJs implements ReduxReactJsInterface
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

    /**
     * {@inheritdoc}
     */
    public function __invoke(string $rootContainer, array $store, string $id)
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
var html = ReactDOMServer.renderToString(React.createElement(Provider, { store: configureStore({$storeJson}) }, React.createElement(App)));
tmp = {html: html};
EOT;
        $v8 = $this->v8->executeString($code);
        $js = "ReactDOM.render(React.createElement(Provider,{store:configureStore($storeJson) },React.createElement(App)),document.getElementById('{$id}'));";

        return [$v8->html, $js];
    }
}
