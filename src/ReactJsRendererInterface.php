<?php
/**
 * This file is part of the Koriym\ReduxReactSsr package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\ReduxReactSsr;

use Koriym\ReduxReactSsr\Exception\RootContainerNotFound;
use V8Js;

interface ReactJsRendererInterface
{
    /**
     * Return ReactJs html
     *
     * @param array $values
     *
     * @return string
     */
    public function render(array $values) : string;
}
