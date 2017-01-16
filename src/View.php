<?php
/**
 * This file is part of the Koriym\ReduxReactSsr package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\ReduxReactSsr;

final class View
{
    /**
     * Server side rendered markup
     *
     * @var string
     */
    public $markup;

    /**
     * Client code to render
     *
     * @var string
     */
    public $js;
}
