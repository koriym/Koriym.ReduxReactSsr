<?php
/**
 * This file is part of the Koriym\ReduxReactSsr package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\ReduxReactSsr;

use Koriym\ReduxReactSsr\Exception\RootContainerNotFound;
use V8Js;

final class ReduxReactJsRenderer implements ReactJsRendererInterface
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
     * @var string
     */
    private $appPublicPath;

    /**
     * @var string
     */
    private $template;

    /**
     * @var string
     */
    private $clientPublicPath;

    /**
     * @param string $appBundleSrc      bundled application code
     * @param string $appPublicPath     app public path for "<script src="
     * @param string $template          html template
     */
    public function __construct(
        string $reactBundleSrc,
        string $appBundleSrc,
        string $clientPublicPath,
        string $template
    ) {
        $this->reactBundleSrc = $reactBundleSrc;
        $this->appBundleSrc = $appBundleSrc;
        $this->template = $template;
        $this->v8 = new V8Js();
        $this->v8->error = function ($container) {
            throw new RootContainerNotFound($container);
        };
        $this->reactBundleSrc = $reactBundleSrc;
        $this->clientPublicPath = $clientPublicPath;
    }

    /**
     * {@inheritdoc}
     */
    public function render(array $values) : string
    {
        $jsCode = $this->getCode($this->reactBundleSrc, $this->appBundleSrc, $values);
        $redux = $this->v8->executeString($jsCode);
        $js = <<<EOT
{$redux->js}
    <script src="{$this->clientPublicPath}"></script>
EOT;
        $html = str_replace(['{{ html }}', '{{ js }}'], [$redux->html, $js], $this->template);

        return $html;
    }

    private function getCode(string $reactBundleSrc, string $appBundleSrc, array $store)
    {
        $rootContainer = 'App';
        $storeJson = json_encode($store);
        $code = <<< "EOT"
var console = {warn: function(){}, error: print};
var global = global || this, self = self || this, window = window || this;
var document = typeof document === 'undefined' ? '' : document;
{$reactBundleSrc}
var React = global.React, ReactDOM = global.ReactDOM, ReactDOMServer = global.ReactDOMServer;
{$appBundleSrc}
var Provider = global.Provider, configureStore = global.configureStore, App = global.{$rootContainer};
if (! App) { PHP.error('{$rootContainer}'); };
var store = configureStore({$storeJson});
App = React.createElement(App);
var html = ReactDOMServer.renderToString(React.createElement(Provider, { store: store }, App));
var state = JSON.stringify(store.getState());
tmp = {html: html, js: '<script>window.__PRELOADED_STATE__ = ' + state + ';</script>'};
EOT;
//        $code = <<< "EOT"
//var console = {warn: function(){}, error: print};
//var global = global || this, self = self || this, window = window || this;
//var document = typeof document === 'undefined' ? '' : document;
//{$reactBundleSrc}
//var React = global.React, ReactDOM = global.ReactDOM, ReactDOMServer = global.ReactDOMServer;
//{$this->clientBundleSrc}
//var Provider = global.Provider, configureStore = global.configureStore, App = global.{$rootContainer};
//if (! App) { PHP.error('{$rootContainer}'); };
//var store = configureStore({$storeJson});
//App = React.createElement(App);
//var html = ReactDOMServer.renderToString(React.createElement(Provider, { store: store }, App));
//var state = JSON.stringify(store.getState());
//tmp = {html: html, js: '<script>window.__PRELOADED_STATE__ = ' + state + ';</script>'};
//EOT;

       return $code;
    }
}
