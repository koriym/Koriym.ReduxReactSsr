<?php
/**
 * This file is part of the Koriym\ReduxReactSsr package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\ReduxReactSsr;

use Koriym\ReduxReactSsr\Exception\RootContainerNotFound;
use V8Js;

final class ReactJsRenderer implements ReactJsRendererInterface
{
    /*
     * @var V8Js
     */
    private $v8;

    /**
     * @var string
     */
    private $reactBundleSrc;

    /**
     * @var string
     */
    private $appBundleSrc;

    /**
     * @var string
     */
    private $reactJsPublicPath;

    /**
     * @var string
     */
    private $appPublicPath;

    /**
     * @var string
     */
    private $template;

    /**
     * @var string
     */
    private $rootContainer;

    /**
     * @var string
     */
    private $domId;

    /**
     * @param string $reactBundleSrc    bundled code include React, ReactDom, and Redux
     * @param string $appBundleSrc      bundled application code
     * @param string $reactJsPublicPath reactjs public path for "<script src="
     * @param string $appPublicPath     app public path for "<script src="
     * @param string $template          html template
     * @param string $rootContainer     root container JSX
     * @param string $domId             root container Dom id
     */
    public function __construct(
        string $reactBundleSrc,
        string $appBundleSrc,
        string $reactJsPublicPath,
        string $appPublicPath,
        string $template,
        string $rootContainer,
        string $domId
    ) {
        $this->reactJsPublicPath = $reactJsPublicPath;
        $this->appPublicPath = $appPublicPath;
        $this->reactBundleSrc = $reactBundleSrc;
        $this->appBundleSrc = $appBundleSrc;
        $this->template = $template;
        $this->rootContainer = $rootContainer;
        $this->domId = $domId;
        $this->v8 = new V8Js();
        $this->v8->error = function ($container) {
            throw new RootContainerNotFound($container);
        };
    }

    /**
     * {@inheritdoc}
     */
    public function render(array $values) : string
    {
        $reactJs = new \ReactJS($this->reactBundleSrc, $this->appBundleSrc);
        $reactJs->setComponent($this->rootContainer, $values);
        $html = $reactJs->getMarkup();
        $jsCode = $reactJs->getJS($this->domId);
        $js = <<<EOT
<script src="{$this->reactJsPublicPath}"></script>
    <script src="{$this->appPublicPath}"></script>
    <script>{$jsCode}</script>
EOT;
        $html = str_replace(['{{ html }}', '{{ js }}'], [$html, $js], $this->template);

        return $html;
    }
}
