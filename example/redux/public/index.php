<?php
require dirname(__DIR__, 3) . '/vendor/autoload.php';

use Koriym\ReduxReactSsr\ReduxReactJsRenderer;

$ssr = new ReduxReactJsRenderer(
    file_get_contents(__DIR__ . '/build/react.bundle.js'),
    file_get_contents(__DIR__ . '/build/app.bundle.js'),
    'build/client.bundle.js',
    '<!DOCTYPE html>
<html>
  <head>
    <title></title>
  </head>
  <body>
    <div id="root">{{ html }}</div>
    {{ js }}
  </body>
</html>');
$html = $ssr->render(['hello' => ['message' => 'Hello, Redux!']]);
echo $html;
