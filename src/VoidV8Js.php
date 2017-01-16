<?php
/**
 * This file is part of the Koriym\ReduxReactSsr package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\ReduxReactSsr;

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
    {}

    /**
     * Provide a function or method to be used to load required modules. This can be any valid PHP callable.
     * The loader function will receive the normalised module path and should return Javascript code to be executed.
     *
     * @param callable $loader
     */
    public function setModuleLoader(callable $loader)
    {}

    /**
     * Provide a function or method to be used to normalise module paths. This can be any valid PHP callable.
     * This can be used in combination with setModuleLoader to influence normalisation of the module path (which
     * is normally done by V8Js itself but can be overriden this way).
     *
     * The normaliser function will receive the base path of the current module (if any; otherwise an empty string)
     * and the literate string provided to the require method and should return an array of two strings (the new
     * module base path as well as the normalised name).  Both are joined by a '/' and then passed on to the
     * module loader (unless the module was cached before).
     *
     * @param callable $normaliser
     */
    public function setModuleNormaliser(callable $normaliser)
    {}

    /**
     * Compiles and executes script in object's context with optional identifier string.
     * A time limit (milliseconds) and/or memory limit (bytes) can be provided to restrict execution. These options will throw a V8JsTimeLimitException or V8JsMemoryLimitException.
     *
     * @param string $script
     * @param string $identifier
     * @param int    $flags
     * @param int    $time_limit    in milliseconds
     * @param int    $memory_limit  in bytes
     *
     * @return string
     */
    public function executeString($script, $identifier = '', $flags = self::FLAG_NONE, $time_limit = 0, $memory_limit = 0)
    {
        return '';
    }

    /**
     * Compiles a script in object's context with optional identifier string.
     *
     * @param string $script
     * @param string $identifier
     *
     * @return void
     */
    public function compileString($script, $identifier = '')
    {}

    /**
     * Executes a precompiled script in object's context.
     * A time limit (milliseconds) and/or memory limit (bytes) can be provided to restrict execution. These options will throw a V8JsTimeLimitException or V8JsMemoryLimitException.
     *
     * @param resource $script
     * @param int      $flags
     * @param int      $time_limit
     * @param int      $memory_limit
     */
    public function executeScript($script, $flags = self::FLAG_NONE, $time_limit = 0, $memory_limit = 0)
    {}

    /**
     * Set the time limit (in milliseconds) for this V8Js object
     * works similar to the set_time_limit php
     *
     * @param int $limit
     */
    public function setTimeLimit($limit)
    {}

    /**
     * Set the memory limit (in bytes) for this V8Js object
     *
     * @param int $limit
     */
    public function setMemoryLimit($limit)
    {}

    /**
     * Returns uncaught pending exception or null if there is no pending exception.
     *
     * @return void
     */
    public function getPendingException()
    {}

    /**
     * Clears the uncaught pending exception
     */
    public function clearPendingException()
    {}

    /**
     * Registers persistent context independent global Javascript extension.
     * NOTE! These extensions exist until PHP is shutdown and they need to be registered before V8 is initialized.
     * For best performance V8 is initialized only once per process thus this call has to be done before any V8Js objects are created!
     *
     * @param string $extension_name
     * @param string $code
     * @param array  $dependencies
     * @param bool   $auto_enable
     *
     * @return void
     */
    public static function registerExtension($extension_name, $code, array $dependencies, $auto_enable = false)
    {}

    /**
     * Returns extensions successfully registered with V8Js::registerExtension().
     *
     * @return void
     */
    public static function getExtensions()
    {}

    /**
     * Creates a custom V8 heap snapshot with the provided JavaScript source embedded.
     * Snapshots are supported by V8 4.3.7 and higher.  For older versions of V8 this
     * extension doesn't provide this method.
     *
     * @since 1.2.0
     * @param string $embed_source
     *
     * @return void
     */
    public static function createSnapshot($embed_source)
    {}
}
