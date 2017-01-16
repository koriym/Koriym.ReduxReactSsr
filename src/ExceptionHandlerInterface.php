<?php
/**
 * This file is part of the Koriym\ReduxReactSsr package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\ReduxReactSsr;

use V8Js;

interface ExceptionHandlerInterface
{
    public function __invoke(\V8JsScriptException $e) : void;
}

