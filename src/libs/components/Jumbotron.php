<?php
/**
 * Created by Yellow Heroes
 * Project: BootWrap
 * File: Jumbotron.php
 * User: Robert
 * Date: 8/22/2020
 * Time: 21:57
 */
declare(strict_types=1);

namespace yellowheroes\bootwrap\libs\components;

use yellowheroes\bootwrap\libs as libs;

/**
 * Builds a Bootstrap Jumbotron component.
 *
 * A lightweight, flexible component that can optionally extend the entire
 * viewport to showcase key marketing messages on your site.
 *
 * @link https://getbootstrap.com/docs/4.0/components/jumbotron/
 *
 * @package yellowheroes\bootwrap\libs\components
 */
class Jumbotron implements libs\ComponentInterface
{
    /**
     * @var string Bootstrap Jumbotron HTML
     */
    private string $html = '';

    /**
     * @var array|null Injected (child) components.
     */
    private ?array $components = [];

    // default config
    private array $colors = [
        'primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light',
        'dark', 'body', 'muted', 'white', 'black-50', 'white-50',
    ];
    private string $bgColor = 'dark';
    private string $txtColor = 'secondary';
    private string $titleSize = '4';

    /**
     * @param ?string $title    The main title
     * @param ?string $subTitle A sub-title
     * @param ?string $msg      A message
     *
     * @return void
     */
    public function build(
        ?string $title = null,
        ?string $subTitle = null,
        ?string $msg = null
    ): void {
        // get config settings
        $bgColor = $this->bgColor;
        $txtColor = $this->txtColor;
        $titleSize = $this->titleSize;

        // create Jumbotron
        $jumbotronOpen = <<<HEREDOC
    <div class="bg-$bgColor text-$txtColor p-5 rounded-3 m-3">
      <h1 class="display-$titleSize">$title</h1>
      <p class="lead">$subTitle</p>
      <hr class="my-4">
      <p>$msg</p>\n
HEREDOC;

        // Injected (child) components - build HTML
        $components = '';
        if (!empty($this->components)) {
            foreach ($this->components as $component) {
                $components .= $component . "\n";
            }
        }

        $jumbotronClose = <<<HEREDOC
    </div>\n
HEREDOC;

        $jumbotronHtml = $jumbotronOpen . $components . $jumbotronClose;

        // store Jumbotron
        $this->set($jumbotronHtml);
    }

    /**
     * Injects a child component.
     *
     * A Jumbotron can be injected with child components (e.g. buttons).
     *
     * @param libs\ComponentInterface $component A component to be injected
     *
     */
    public function inject(libs\ComponentInterface $component): void
    {
        $this->components[] = $component->get();
    }

    /**
     * @return string   Component HTML built with Jumbotron::build().
     */
    public function get(): string
    {
        return $this->html;
    }

    /**
     * @param string $html Component HTML built with Jumbotron::build().
     */
    private function set(string $html): void
    {
        $this->html = $html;
    }

    /**
     * @return string
     */
    public function getBgColor(): string
    {
        return $this->bgColor;
    }

    /**
     * @param string $bgColor
     *
     * @return $this
     */
    public function setBgColor(string $bgColor): Jumbotron
    {
        if (in_array($bgColor, $this->colors)) {
            $this->bgColor = $bgColor;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getTxtColor(): string
    {
        return $this->txtColor;
    }

    /**
     * @param string $txtColor
     *
     * @return $this
     */
    public function setTxtColor(string $txtColor): Jumbotron
    {
        if (in_array($txtColor, $this->colors)) {
            $this->txtColor = $txtColor;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getTitleSize(): string
    {
        return $this->titleSize;
    }

    /**
     * @param string $titleSize
     *
     * @return $this
     */
    public function setTitleSize(string $titleSize): Jumbotron
    {
        if ($titleSize >= 1 && $titleSize <= 6) $this->titleSize = $titleSize;
        return $this;
    }
}