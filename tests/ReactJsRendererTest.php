<?php

namespace BEAR\ReactJsModule;

use Koriym\ReduxReactSsr\ReactJsRenderer;

class ReactJsRendererTest extends \PHPUnit_Framework_TestCase
{
    public function testNew()
    {
        $template = <<<EOT
<!DOCTYPE html>
<html>
  <head>
    <title></title>
  </head>
  <body>
    <div id="root">{{ html }}</div>
    {{ js }}
  </body>
</html>
EOT;
        $ssr = new ReactJsRenderer(
            file_get_contents(__DIR__ . '/build/reactjs/react.bundle.js'),
            file_get_contents(__DIR__ . '/build/reactjs/helloworld.bundle.js'),
            '/build/react.bundle.js',
            '/build/helloworld.bundle.js',
            $template,
            'HelloWorld',
            'root'
        );
        $this->assertInstanceOf(ReactJsRenderer::class, $ssr);

        return $ssr;
    }

    /**
     * @depends testNew
     */
    public function testRender(ReactJsRenderer $ssr)
    {
        $html = $ssr->render(['name' => 'World']);
        $this->assertContains('<!-- react-text: 3 -->Hello <!-- /react-text --><!-- react-text: 4 -->World<!-- /react-text -->', $html);
        $this->assertContains('<script src="/build/react.bundle.js"></script>', $html);
        $this->assertContains('<script src="/build/helloworld.bundle.js"></script>', $html);
    }
}
