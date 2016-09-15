# Install V8JS

## OSX

```
brew update
brew install homebrew/php/php70-v8js
```

`php.ini`に追加
```
extension=v8js.so
```

`php -i`で確認

```
v8js

V8 Javascript Engine => enabled
V8 Engine Compiled Version => 5.1.281.47
V8 Engine Linked Version => 5.1.281.47
Version => 1.3.0

Directive => Local Value => Master Value
v8js.compat_php_exceptions => 0 => 0
v8js.flags => no value => no value
v8js.use_array_access => 0 => 0
v8js.use_date => 0 => 0
```
