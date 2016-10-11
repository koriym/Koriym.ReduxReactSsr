<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

$reactJs = new \ReactJS(
    file_get_contents(__DIR__ . '/build/react.bundle.js'),
    file_get_contents(__DIR__ . '/build/helloworld.bundle.js')
);
$reactJs->setComponent('HelloWorld', ['name' => 'World']);
$html = $reactJs->getMarkup();
$js = $reactJs->getJS('#root');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Hello ReactJS-SSR</title>
  </head>
  <body>
    <!-- render server content here -->
    <div id="root"><?php echo $html; ?></div>
    <!-- load react and app code -->
    <script src="build/react.bundle.js"></script>
    <script src="build/helloworld.bundle.js"></script>
    <!-- client init/render -->
    <script><?php echo $js; ?></script>
  </body>
</html>
