<?php
/**
 * Created by Yellow Heroes
 * Project: BootWrap
 * File: Navbar.php
 * User: Robert
 * Date: 8/22/2020
 * Time: 21:57
 */
declare(strict_types=1);

namespace yellowheroes\bootwrap\libs\components;

use yellowheroes\bootwrap\libs as libs;

/**
 * Builds a Bootstrap Navbar component.
 *
 * Bootstrap’s powerful, responsive navigation header, the navbar.
 * Includes support for branding, navigation, and more,
 * including support for Bootstrap's collapse plugin.
 *
 * @link    https://getbootstrap.com/docs/4.0/components/navbar/
 *
 * @package yellowheroes\bootwrap\libs\components
 */
class Navbar implements libs\ComponentInterface
{
    /**
     * @var string Bootstrap Navbar component (HTML)
     */
    private string $component = '';

    /**
     * @var array|null Injected (child) components.
     */
    private ?array $components = [];

    // default config
    private array $colors = [
        'primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light',
        'dark', 'body', 'muted', 'white', 'black-50', 'white-50', 'off'
    ];
    private string $bgColor = 'dark';
    private string $txtColor = 'secondary';
    private string $titleSize = '4';
    private string $padding = '3';
    private string $rounded = '3';
    private string $margin = '3';
    private string $rulerMargin = '4';
    private ?string $customClass = null; // set your proprietary css classes

    /**
     * @param ?string $title    The main title
     * @param ?string $subTitle A sub-title
     * @param ?string $msg      A (marketing) message
     *
     * @return void
     */
    public function build(
        ?string $title = null,
        ?string $subTitle = null,
        ?string $msg = null
    ): void {
        // TODO: create Navbar
       $navbar = '';

        // Injected (child) components - build HTML
        $components = '';
        if (!empty($this->components)) {
            foreach ($this->components as $component) {
                $components .= $component . "\n";
            }
        }

        // store Navbar
        $this->component = $navbar;
    }

    /**
     * Injects a child component.
     *
     * A Navbar can be injected with child components.
     *
     * @param libs\ComponentInterface $component A component to be injected
     *
     */
    public function inject(libs\ComponentInterface $component): void
    {
        $this->components[] = $component->get();
    }

    /**
     * @return string   Component (HTML) built with Navbar::build().
     */
    public function get(): string
    {
        return $this->component;
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
    public function setBgColor(string $bgColor): Navbar
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
    public function setTxtColor(string $txtColor): Navbar
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
     * @param int $titleSize
     *
     * @return $this
     */
    public function setTitleSize(int $titleSize): Navbar
    {
        if ($titleSize >= 1 && $titleSize <= 6) $this->titleSize = (string)$titleSize;
        return $this;
    }

    /**
     * @return string
     */
    public function getPadding(): string
    {
        return $this->padding;
    }

    /**
     * @param int $padding
     *
     * @return Navbar
     */
    public function setPadding(int $padding): Navbar
    {
        $this->padding = (string)$padding;
        return $this;
    }

    /**
     * @return string border-radius
     */
    public function getRounded(): string
    {
        return $this->rounded;
    }

    /**
     * @param int    $size  border-radius 0-3.
     * @param string $style 'top', 'end', 'bottom', 'start', 'pill'.
     *
     * @return $this
     */
    public function setRounded(int $size, string $style): Navbar
    {
        $size = ($size >= 0 && $size <= 3) ? (string)$size : $this->rounded;
        $styles = ['top', 'end', 'bottom', 'start', 'pill'];
        $style = in_array($style, $styles) ? $style : '';
        $this->rounded = (!empty($style)) ? $size . ' rounded-' . $style : $size;

        return $this;
    }

    /**
     * @return string margin of the Navbar
     */
    public function getMargin(): string
    {
        return $this->margin;
    }

    /**
     * @param int $margin 0-5 or -1 for 'auto'
     *
     * @return Navbar
     */
    public function setMargin(int $margin): Navbar
    {
        if ($margin >= 0 && $margin <= 5) $this->margin = (string)$margin;
        elseif ($margin === -1) $this->margin = 'auto';
        return $this;
    }

    /**
     * @return string the margin around the horizontal ruler
     */
    public function getRulerMargin(): string
    {
        return $this->rulerMargin;
    }

    /**
     * @param int $rulerMargin 0-5 or -1 for 'auto'
     *
     * @return $this
     */
    public function setRulerMargin(int $rulerMargin): Navbar
    {
        if ($rulerMargin >= 0 && $rulerMargin <= 5) $this->rulerMargin = (string)$rulerMargin;
        elseif ($rulerMargin === -1) $this->rulerMargin = 'auto';
        return $this;
    }

    /**
     * @param string|null $customClass  custom (non Bootstrap) CSS class name(s)
     */
    public function setCustomClass(?string $customClass): void
    {
        $this->customClass = $customClass;
    }
}