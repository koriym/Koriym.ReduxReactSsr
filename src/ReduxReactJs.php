<?php
/**
 * This file is part of the Koriym\ReduxReactSsr package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\ReduxReactSsr;

use V8Js;

final class ReduxReactJs implements ReduxReactJsInterface
{
    /**
     * @var string
     */
    private $reactBundleSrc;

    /**
     * @var string
     */
    private $appBundleSrc;

    /**
     * @var ExceptionHandler
     */
    private $handler;

    /*
     * @var V8Js
     */
    private $v8;

    /**
     * @param string           $reactBundleSrc Bundled code include React, ReactDom, and Redux
     * @param string           $appBundleSrc   Bundled application code
     * @param ExceptionHandler $handler        V8Js exception handler
     */
    public function __construct(string $reactBundleSrc, string $appBundleSrc, ExceptionHandler $handler, V8Js $v8Js)
    {
        $this->reactBundleSrc = $reactBundleSrc;
        $this->appBundleSrc = $appBundleSrc;
        $this->handler = $handler;
        $this->v8 = $v8Js;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(string $rootContainer, array $store, string $id) : View
    {
        $storeJson = json_encode($store);
        $code = $this->getServerSideRenderingCode($rootContainer, $storeJson);
        $view = new View;
        try {
            $v8 = $this->v8->executeString($code);
            $view->html = $v8->html;
        } catch (\V8JsScriptException $e) {
            $this->handler->__invoke($e);
            $view->html = '';
        }
        $view->js = "ReactDOM.render(React.createElement(Provider,{store:configureStore($storeJson)},React.createElement(App)),document.getElementById('{$id}'));";

        return $view;
    }

    private function getServerSideRenderingCode(string $rootContainer, string $storeJson) : string
    {
        $code = <<< "EOT"
var console = {warn: function(){}, error: print};
var global = global || this, self = self || this, window = window || this;
var document = typeof document === 'undefined' ? '' : document;
{$this->reactBundleSrc}
var React = global.React, ReactDOM = global.ReactDOM, ReactDOMServer = global.ReactDOMServer;
{$this->appBundleSrc}
var Provider = global.Provider, configureStore = global.configureStore, App = global.{$rootContainer};
var html = ReactDOMServer.renderToString(React.createElement(Provider, { store: configureStore({$storeJson}) }, React.createElement(App)));
tmp = {html: html};
EOT;

        return $code;
    }
}
