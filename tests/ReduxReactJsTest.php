<?php

namespace BEAR\ReactJsModule;

use Koriym\ReduxReactSsr\Exception\RootContainerNotFound;
use Koriym\ReduxReactSsr\ReduxReactJs;

class ReactReduxJsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ReduxReactJs
     */
    private $ssr;

    public function __construct()
    {
        $reactBundleJs = file_get_contents(__DIR__ . '/builds/redux/react.bundle.js');
        $appBundleJs = file_get_contents(__DIR__ . '/builds/redux/app.bundle.js');
        $this->ssr = new ReduxReactJs($reactBundleJs, $appBundleJs);
    }

    public function testInvoke()
    {
        $state = ['hello'=> ['message' => 'Hello SSR !']];
        list($html, $js) = $this->ssr->__invoke('App', $state, 'root');
        $this->assertStringStartsWith('<div data-reactroot=', $html);
        $this->assertContains('<h1 data-reactid="3">Hello SSR !</h1>', $html);
        $this->assertSame('ReactDOM.render(React.createElement(Provider,{store:configureStore({"hello":{"message":"Hello SSR !"}}) },React.createElement(App)),document.getElementById(\'root\'));', $js);
    }
    
    public function testInvalidContainerName()
    {
        $this->expectException(RootContainerNotFound::class);
        $state = ['hello'=> ['message' => 'Hello SSR !']];
        $this->ssr->__invoke('__INVALID__', $state, 'root');
    }

    public function testInvalidReducerNameSpace()
    {
        $this->expectOutputString('Unexpected key "__INVALID__" found in preloadedState argument passed to createStore. Expected to find one of the known reducer keys instead: "hello". Unexpected keys will be ignored.');
        $state = ['__INVALID__'=> ['message' => 'Hello SSR !']];
        $this->ssr->__invoke('App', $state, 'root');
    }

    public function testInvalidState()
    {
        $this->hasExpectationOnOutput('Warning: Failed prop type');
        $state = ['hello'=> ['__INVALID__' => 'Hello SSR !']];
        $this->ssr->__invoke('App', $state, 'root');
    }
}
