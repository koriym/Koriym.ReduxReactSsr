<?php
/**
 * This file is part of the Koriym\ReduxReactSsr package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\ReduxReactSsr;

final class ExceptionHandler implements ExceptionHandlerInterface
{
    public function __invoke(\V8JsScriptException $e) : void
    {
        $erroCode = substr($e->getJsSourceLine(), $e->getJsStartColumn(), 100);
        $errorMsg = sprintf(
            'V8JsScriptException:%s -> %s ',
            $e->getMessage(),
            $erroCode . ' ...'
        );
        trigger_error($errorMsg, E_USER_WARNING); // to be continued
    }
}
