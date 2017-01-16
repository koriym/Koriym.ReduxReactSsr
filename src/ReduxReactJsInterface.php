<?php
/**
 * This file is part of the Koriym\ReduxReactSsr package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\ReduxReactSsr;

interface ReduxReactJsInterface
{
    /**
     * Return Redux server side rendered code
     *
     * @param string $rootContainer redux container
     * @param array  $store         preload state
     * @param string $id            element id
     *
     * @return array [$markup, $js]
     */
    public function __invoke(string $rootContainer, array $store, string $id) : View;
}
