<?php

namespace BEAR\ReactJsModule;

use Koriym\ReduxReactSsr\ExceptionHandler;
use Koriym\ReduxReactSsr\ReduxReactJs;
use V8Js;

class ReduxReactJsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ReduxReactJs
     */
    private $ssr;

    public function setUp()
    {
        $reactBundleJs = file_get_contents(__DIR__ . '/fake/redux-app/public/build/react.bundle.js');
        $appBundleJs = file_get_contents(__DIR__ . '/fake/redux-app/public/build/app.bundle.js');
        $this->ssr = new ReduxReactJs($reactBundleJs, $appBundleJs, new ExceptionHandler, new V8Js);
    }

    public function testInvoke()
    {
        $state = ['hello' => ['message' => 'Hello SSR !']];
        $view = $this->ssr->__invoke('App', $state, 'root');
        $this->assertStringStartsWith('<div data-reactroot=', $view->markup);
        $this->assertContains('<h1 data-reactid="3">Hello SSR !</h1>', $view->markup);
        $this->assertSame('ReactDOM.render(React.createElement(Provider,{store:configureStore({"hello":{"message":"Hello SSR !"}})},React.createElement(App)),document.getElementById(\'root\'));', $view->js);
    }

    public function testInvalidReducerNameSpace()
    {
        $this->expectOutputString('Unexpected key "__INVALID__" found in preloadedState argument passed to createStore. Expected to find one of the known reducer keys instead: "hello". Unexpected keys will be ignored.');
        $state = ['__INVALID__' => ['message' => 'Hello SSR !']];
        $this->ssr->__invoke('App', $state, 'root');
    }

    public function testInvalidState()
    {
        $this->expectOutputRegex('/Warning: Failed prop type/');
        $state = ['hello' => ['__INVALID__' => 'Hello SSR !']];
        $this->ssr->__invoke('App', $state, 'root');
    }

    public function testInvalidValue()
    {
        $state = ['hello' => ['__INVALID__' => 'Hello SSR !']];
        $view = @$this->ssr->__invoke('_INVALID_', $state, 'root');
        $this->assertSame('', $view->markup);
    }
}
