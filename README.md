# redux-react-ssr

**redux-react-ssr** is a library that uses the power of Facebook's React Redux library to render UI components on the server-side with PHP as well as on the client.

## Prerequisites

 * php7.1
 * [V8Js](http://php.net/v8js) (optional for development)

## Usage

```php
<?php
require dirname(__DIR__, 3) . '/vendor/autoload.php';

use Koriym\ReduxReactSsr\ReduxReactJs;

$ssr = new ReduxReactJs(
    file_get_contents(__DIR__ . '/build/react.bundle.js'),
    file_get_contents(__DIR__ . '/build/app.bundle.js'),
    new ExceptionHandler(),
    new V8Js()
);
$view = $ssr('App', ['hello' => ['message' => 'Hello, Redux!']], 'root');
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
```

## No V8Js enviroment

It is posibble to use without V8Js extention for development. In that case, Render method return no markup but enable to render by only client without error.

## Installation
   
```
composer require koriym/redux-react-ssr
```

## Testing redux-react-ssr

```
git clone git@github.com:koriym/Koriym.ReduxReactSsr.git
composer install
cd Koriym.ReduxReactSsr/example/redux
npm install
npm run build
npm start
```

## Install V8Js

### OSX

```
brew update
brew install homebrew/php/php71-v8js
```

edit `php.ini` or add 'V8Js.ini'

```
extension="/usr/local/opt/php71-v8js/v8js.so"
```

