# Koriytm.ReduxReactSsr

Koriytm.ReduxReduxSsr renders Redux React UI on the server-side with PHP as well as on the client.

## Prerequisites

 * php7
 * [V8Js](http://php.net/v8js)

## Usage

```
<?php

use Koriym\ReduxReactSsr\ReduxReactSsr;

require dirname(__DIR__) . '/vendor/autoload.php';
$ssr = new ReduxReactSsr(
    file_get_contents(__DIR__ . '/build/react.bundle.js'),
    file_get_contents(__DIR__ . '/build/app.bundle.js')
);
// set initial state for SSR
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
```

When you don't put html into `<div id="root">`, it still work as CSR (Client Side Rendering) page.

* SSR:`<div id="root"><?php echo $html; ?></div>`
* CSR:`<div id="root"></div>`

## Run example

```
git clone git@github.com:koriym/Koriym.ReduxReactSsr.git
composer install
cd Koriym.ReduxReactSsr/example/
npm install
npm run build
npm start
```

 * `http://127.0.0.1:3000/` for SSR
 * `http://127.0.0.1:3000/index.html` for CSR
