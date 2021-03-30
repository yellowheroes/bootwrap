<?php
/**
 * Created by Yellow Heroes
 * Project: bootwrap
 * File: Link.php
 * User: Robert
 * Date: 3/23/2021
 * Time: 10:15
 */
declare(strict_types=1);

namespace yellowheroes\bootwrap\libs\components;

use yellowheroes\bootwrap\libs as libs;

/**
 * Builds a Link component.
 *
 * Light text-only links that can be embedded inside normal text.
 *
 * @package yellowheroes\bootwrap\libs\components
 */
class Link implements libs\ComponentInterface
{
    /**
     * @var string Bootstrap Jumbotron component (HTML)
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
    private string $txtColor = 'primary';
    private ?string $customClass = null; // set your proprietary css classes

    /**
     * @param string|null $uri     A uri for a linked resource
     * @param string|null $display A hypertext link-text
     *
     * @return void
     */
    public function build(
        ?string $uri = null,
        ?string $display = null
    ): void {
        // Injected (child) components - build HTML
        $components = '';
        if (!empty($this->components)) {
            foreach ($this->components as $component) {
                $components .= $component . "\n";
            }
        }

        // create Link
        $link = <<<HEREDOC
<span><a class="$this->customClass text-$this->txtColor quick-links" href="$uri">$display</a> $components</span>
HEREDOC;

        // store Link
        $this->component = $link;
    }

    /**
     * Injects a child component.
     *
     * A Link can be injected with child components (e.g. badge)
     *
     * @param libs\ComponentInterface $component A component to be injected
     *
     */
    public function inject(libs\ComponentInterface $component): void
    {
        $this->components[] = $component->get();
    }

    /**
     * @return string   Component HTML built with Link::build()
     */
    public function get(): string
    {
        return $this->component;
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
    public function setTxtColor(string $txtColor): Link
    {
        $this->txtColor = $txtColor;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCustomClass(): ?string
    {
        return $this->customClass;
    }

    /**
     * @param string|null $customClass Add your custom CSS class for styling hyperlinks
     *
     * @return $this
     */
    public function setCustomClass(?string $customClass): Link
    {
        $this->customClass = $customClass;
        return $this;
    }
}