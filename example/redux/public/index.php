<?php
require dirname(__DIR__, 3) . '/vendor/autoload.php';

use Koriym\ReduxReactSsr\ReduxReactJsRenderer;

$ssr = new ReduxReactJsRenderer(
    file_get_contents(__DIR__ . '/build/react.bundle.js'),
    file_get_contents(__DIR__ . '/build/app.bundle.js'),
    'build/client.bundle.js'
);
list($markup, $js) = $ssr->__invoke(['hello' => ['message' => 'Hello, Redux!']]);
$html = <<<EOT
<!DOCTYPE html>
<html>
  <head>
    <title></title>
  </head>
  <body>
    <div id="root">{$markup}</div>
    {$js}
  </body>
</html>
EOT;

echo $html;
