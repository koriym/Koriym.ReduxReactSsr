<?php
require dirname(__DIR__, 3) . '/vendor/autoload.php';

use Koriym\ReduxReactSsr\ReduxReactSsr;

$ssr = new ReduxReactSsr(
    file_get_contents(__DIR__ . '/build/react.bundle.js'),
    file_get_contents(__DIR__ . '/build/app.bundle.js')
);
list($markup, $js) = $ssr('App', ['hello' => ['message' => 'Hello, Redux!']]);
$html = <<<EOT
<!DOCTYPE html>
<html>
  <head>
    <title></title>
  </head>
  <body>
    <div id="root">{$markup}</div>
    {$js}
   <script src="build/client.bundle.js"></script>
  </body>
</html>
EOT;

echo $html;
