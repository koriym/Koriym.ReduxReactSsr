# ReduxReactSsr

**ReduxReactSsr** is a library that uses the power of Facebook's React Redux library to render UI components on the server-side with PHP as well as on the client.

## Prerequisites

 * php7
 * [V8Js](http://php.net/v8js)

## Usage

```php
<?php
require dirname(__DIR__, 3) . '/vendor/autoload.php';

use Koriym\ReduxReactSsr\ReduxReactJs;

$ssr = new ReduxReactJs(
    file_get_contents(__DIR__ . '/build/react.bundle.js'),
    file_get_contents(__DIR__ . '/build/app.bundle.js')
);
list($markup, $js) = $ssr('App', ['hello' => ['message' => 'Hello, Redux!']], 'root');
$html = <<<EOT
<!DOCTYPE html>
<html>
  <head>
    <title></title>
  </head>
  <body>
    <div id="root">{$markup}</div>
    <script src="build/react.bundle.js"></script>
    <script src="build/app.bundle.js"></script>
    <script>{$js}</script>
  </body>
</html>
EOT;

echo $html;
```

## Run example

```
git clone git@github.com:koriym/Koriym.ReduxReactSsr.git
composer install
cd Koriym.ReduxReactSsr/example/redux
npm install
npm run build
npm start
```
