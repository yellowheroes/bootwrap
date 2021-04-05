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
        'dark', 'body', 'white', 'transparent', 'muted', 'black-50', 'white-50',
        'off',
    ];
    private string $theme = 'dark'; // 'light' for light background colors
    private string $bgColor = 'dark'; // 'light' background colors with 'light' theme
    private string $txtColor = 'secondary';
    private string $titleSize = '4';
    private string $padding = '3';
    private string $rounded = '3';
    private string $margin = '3';
    private string $rulerMargin = '4';
    private ?string $customClass = null; // set your proprietary css classes

    /**
     * @param array       $navItems  [$uri => $display-name, ...].
     * @param string|null $active    The display-name of the active page.
     * @param string|null $brandName Company, product, or project name.
     */
    public function build(
        array $navItems = [],
        ?string $active = '',
        ?string $brandName = null
    ): void {
        // Injected (child) components - build HTML
        $components = '';
        if (!empty($this->components)) {
            foreach ($this->components as $component) {
                $components .= $component . "\n";
            }
        }

        // Create Navbar
        $navLinks = ''; // basic navigation links
        $dropDown = ''; // drop-down navigation menu
        $activePage = null;
        foreach ($navItems as $uri => $display) {
            $activePage = ($active === $display) ? 'active' : null;
            $current = ($active === $display) ? 'aria-current="page"' : null;
            if (is_array($display)) {
                // for a dropdown, $uri is the dropdown 'header'
                $activePage = ($active === $uri) ? 'active' : null;
                $current = ($active === $uri) ? 'aria-current="page"' : null;
                $dropDown .= <<<HEREDOC
<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle $activePage $this->customClass" $current href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                $uri
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">\n
HEREDOC;
                foreach ($display as $ddUri => $ddDisplay) {
                    $dropDown .= <<<HEREDOC
                <li><a class="dropdown-item" href="$ddUri">$ddDisplay</a></li>\n
HEREDOC;
                }
                $dropDown .= <<<HEREDOC
            </ul>
            </li>
HEREDOC;
                $navLinks .= $dropDown; // inject dropdown menu in navbar
            } else {
                $navLinks .= <<<HEREDOC
<li class="nav-item">
             <a class="nav-link $activePage $this->customClass" $current href="$uri">$display</a>
            </li>\n\t\t\t
HEREDOC;
            }
        }

        $navbar = <<<HEREDOC
    <nav class="navbar navbar-expand-lg navbar-$this->theme bg-$this->bgColor">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">$brandName</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            $navLinks
          </ul>
        </div>
      </div>
    </nav>
HEREDOC;

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
    public function getTheme(): string
    {
        return $this->theme;
    }

    /**
     * @param string $theme
     *
     * @return $this
     */
    public function setTheme(string $theme): Navbar
    {
        $this->theme = $theme;
        return $this;
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
     * @return $this
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
     * @return $this
     *
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
     * @param string|null $customClass custom (non Bootstrap) CSS class name(s)
     */
    public function setCustomClass(?string $customClass): void
    {
        $this->customClass = $customClass;
    }
}