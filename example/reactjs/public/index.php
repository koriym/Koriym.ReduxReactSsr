<?php
require dirname(__DIR__, 3) . '/vendor/autoload.php';

$reactJs = new \ReactJS(
    file_get_contents(__DIR__ . '/build/react.bundle.js'),
    file_get_contents(__DIR__ . '/build/helloworld.bundle.js')
);
$reactJs->setComponent('HelloWorld', ['name' => 'ReactJs']);
$markup = $reactJs->getMarkup();
$js = $reactJs->getJS('#root');
$html = <<<EOT
<!DOCTYPE html>
<html>
  <head>
    <title></title>
  </head>
  <body>
    <div id="root">{$markup}</div>
    <script src="build/react.bundle.js"></script>
    <script src="build/helloworld.bundle.js"></script>
    <script>{$js}</script>
  </body>
</html>
EOT;

echo $html;