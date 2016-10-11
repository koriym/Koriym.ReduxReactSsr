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
    <title>Hello SSR</title>
  </head>
  <body>
    <div id="root"><?php echo $html; ?></div>
    <script src="build/react.bundle.js"></script>
    <script src="build/helloworld.bundle.js"></script>
  </body>
</html>
