<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Koriym\ReduxReactSsr\ReduxReactSsr;

$ssr = new ReduxReactSsr(
    file_get_contents(__DIR__ . '/build/react.bundle.js'),
    file_get_contents(__DIR__ . '/build/app.bundle.js')
);
$state = ['hello'=> ['message' => 'Hello SSR !']];
list($html, $js) = $ssr('App', $state);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Hello SSR</title>
  </head>
  <body>
    <div id="root"><?php echo $html; ?></div>
    <?php echo $js ?>
    <script src="build/react.bundle.js"></script>
    <script src="build/client.bundle.js"></script>
  </body>
</html>
