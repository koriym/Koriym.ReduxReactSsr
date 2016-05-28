<?php
/**
 * This file is part of the Koriym\ReduxReactSsr package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\ReduxReactSsr;

interface ReduxSsrInterface
{
    public function __invoke(string $rootContainer, array $store);
}
