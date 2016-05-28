<?php

namespace BEAR\ReactJsModule;

use Koriym\ReduxReactSsr\Exception\RootContainerNotFound;
use Koriym\ReduxReactSsr\ReduxReactSsr;

class ReactReduxSsrTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ReduxReactSsr
     */
    private $ssr;

    public function __construct()
    {
        $reactBundleJs = file_get_contents(dirname(__DIR__) . '/example/build/react.bundle.js');
        $appBundleJs = file_get_contents(dirname(__DIR__) . '/example/build/app.bundle.js');
        $this->ssr = new ReduxReactSsr($reactBundleJs, $appBundleJs);
    }

    public function testInvoke()
    {
        $state = ['hello'=> ['message' => 'Hello SSR !']];
        list($html, $js) = $this->ssr->__invoke('App', $state);
        // html
        // <div data-reactroot="" data-reactid="1" data-react-checksum="-1640222389"><div data-reactid="2"><h1 data-reactid="3">Hello SSR !</h1><button data-reactid="4">Click</button></div></div>
        // js
        // <script>window.__PRELOADED_STATE__ = {"hello":{"message":"Hello SSR !"}};</script>
        $this->assertStringStartsWith('<div data-reactroot=', $html);
        $this->assertContains('<h1 data-reactid="3">Hello SSR !</h1>', $html);
        $this->assertSame('<script>window.__PRELOADED_STATE__ = {"hello":{"message":"Hello SSR !"}};</script>' . PHP_EOL, $js);
    }
    
    public function testInvalidContainerrName()
    {
        $this->expectException(RootContainerNotFound::class);
        $state = ['hello'=> ['message' => 'Hello SSR !']];
        $this->ssr->__invoke('__INVALID__', $state);
    }

    public function testInvalidReducerNameSpace()
    {
        $this->expectOutputString('Unexpected key "__INVALID__" found in initialState argument passed to createStore. Expected to find one of the known reducer keys instead: "hello". Unexpected keys will be ignored.');
        $state = ['__INVALID__'=> ['message' => 'Hello SSR !']];
        $this->ssr->__invoke('App', $state);
    }

    public function testInvalidState()
    {
        $this->expectOutputString('Warning: Failed propType: Required prop `message` was not specified in `Hello`.');
        $state = ['hello'=> ['__INVALID__' => 'Hello SSR !']];
        $this->ssr->__invoke('App', $state);
    }
}
