<?php
require dirname(__DIR__, 3) . '/vendor/autoload.php';

use Koriym\ReduxReactSsr\ExceptionHandler;
use Koriym\ReduxReactSsr\ReduxReactJs;

$reduxReact = new ReduxReactJs(
    file_get_contents(__DIR__ . '/build/react.bundle.js'),
    file_get_contents(__DIR__ . '/build/app.bundle.js'),
    new ExceptionHandler(),
    new V8Js()
);
$view = $reduxReact('App', ['hello' => ['message' => 'Hello, Redux!']], 'root');
$html = <<<EOT
<!DOCTYPE html>
<html>
  <head>
    <title></title>
  </head>
  <body>
    <div id="root">{$view->markup}</div>
    <script src="build/react.bundle.js"></script>
    <script src="build/app.bundle.js"></script>
    <script>{$view->js}</script>
  </body>
</html>
EOT;

echo $html;
