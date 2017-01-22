<?php
// @codingStandardsIgnoreFile
/**
 * This file is part of the Koriym\ReduxReactSsr package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\ReduxReactSsr;

/**
 * @SuppressWarnings(PHPMD)
 */
final class VoidV8Js extends \V8Js
{
    const V8_VERSION = '';

    const FLAG_NONE = 1;
    const FLAG_FORCE_ARRAY = 2;
    const FLAG_PROPAGATE_PHP_EXCEPTIONS = 4;

    /**
     * Initializes and starts V8 engine and Returns new V8Js object with it's own V8 context.
     *
     * @param string $object_name
     * @param array  $variables
     * @param array  $extensions
     * @param bool   $report_uncaught_exceptions
     * @param string $snapshot_blob
     */
    public function __construct($object_name = 'PHP', array $variables = null, array $extensions = null, $report_uncaught_exceptions = true, $snapshot_blob = null)
    {
    }

    /**
     * Compiles and executes script in object's context with optional identifier string.
     * A time limit (milliseconds) and/or memory limit (bytes) can be provided to restrict execution. These options will throw a V8JsTimeLimitException or V8JsMemoryLimitException.
     *
     * @param string $script
     * @param string $identifier
     * @param int    $flags
     * @param int    $time_limit   in milliseconds
     * @param int    $memory_limit in bytes
     *
     * @return string
     */
    public function executeString($script, $identifier = '', $flags = self::FLAG_NONE, $time_limit = 0, $memory_limit = 0)
    {
        return new class {
            public $markup = '';
        };
    }
}
