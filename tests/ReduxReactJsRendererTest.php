<?php

namespace BEAR\ReactJsModule;

use Koriym\ReduxReactSsr\ReduxReactJsRenderer;

class ReduxReactJsRendererTest extends \PHPUnit_Framework_TestCase
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
        $ssr = new ReduxReactJsRenderer(
            file_get_contents(__DIR__ . '/builds/redux/react.bundle.js'),
            file_get_contents(__DIR__ . '/builds/redux/app.bundle.js'),
            'redux/build/client.bundle.js',
            $template
        );
        $this->assertInstanceOf(ReduxReactJsRenderer::class, $ssr);

        return $ssr;
    }

    /**
     * @depends testNew
     */
    public function testRender(ReduxReactJsRenderer $ssr)
    {
        $html = $ssr->render(['hello' => ['message' => 'Hello, Redux!']]);
        $this->assertContains('<script src="redux/build/client.bundle.js"></script>', $html);
        $this->assertContains('<script>window.__PRELOADED_STATE__ = {"hello":{"message":"Hello, Redux!"}};</script>', $html);
    }
}
