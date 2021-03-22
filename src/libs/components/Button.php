<?php
/**
 * Created by Yellow Heroes
 * Project: bootwrap
 * File: Alert.php
 * User: Robert
 * Date: 8/22/2020
 * Time: 21:57
 */
declare(strict_types=1);

namespace yellowheroes\bootwrap\libs\components;

use yellowheroes\bootwrap\libs as libs;

/**
 * Builds a Button component
 *
 * Use Bootstrap’s custom button styles for actions in forms, dialogs,
 * and more with support for multiple sizes, states, and more.
 *
 * @link    https://getbootstrap.com/docs/5.0/components/buttons/
 *
 * @package yellowheroes\bootwrap\libs\components
 */
class Button implements libs\ComponentInterface
{
    /**
     * @var string Bootstrap Button HTML
     */
    private string $html = '';

    /**
     * @var array|null Injected (child) components
     */
    private ?array $components = [];

    // default config
    private array $colors = [
        'primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light',
        'dark', 'body', 'muted', 'white', 'black-50', 'white-50',
    ];
    private array $types = ['button', 'submit', 'href', 'reset'];
    private string $bgColor = 'dark';
    private string $txtColor = 'secondary';
    private string $type = 'button';
    private string $href = '';
    private string $size = 'sm';
    private bool $outline = false;

    /**
     * @param string|null $id      The id must be unique
     * @param string|null $display The text on a button
     * @param string|null $name    Submitted as form data (e.g. $_POST['id'])
     *
     * @return void
     */
    public function build(
        ?string $id = null,
        ?string $display = null,
        ?string $name = null
    ): void {
        // get the config settings
        $bgColor = $this->bgColor ?? null;
        $txtColor = $this->txtColor ?? null;
        $type = $this->type ?? null;
        $size = $this->size ?? null;
        $outline = $this->outline ?? null;

        // Injected (child) components - build HTML
        $components = '';
        if (!empty($this->components)) {
            foreach ($this->components as $component) {
                $components .= $component . "\n";
            }
        }

        // create Button
        $id = $id ?? uniqid();
        $name = $name ?? $id;
        if ($type !== 'href') {
            $buttonHtml = <<<HEREDOC
<button id="$id" name="$name" type="$type" class="btn btn-$size btn-{$outline}$bgColor $txtColor">$display $components</button>
HEREDOC;
        } else {
            $href = $this->href;
            $buttonHtml = <<<HEREDOC
<a id="$id" class="btn btn-{$outline}$bgColor btn-$size $txtColor" href="$href" role="button">$display</a>
HEREDOC;
        }

        // store Button
        $this->set($buttonHtml);
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
     * @return string   Component HTML built with Button::build()
     */
    public function get(): string
    {
        return $this->html;
    }

    /**
     * @param string $html Component HTML built with Button::build()
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
     * @return Button
     */
    public function setBgColor(string $bgColor): Button
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
     * @return Button
     */
    public function setTxtColor(string $txtColor): Button
    {
        if (in_array($txtColor, $this->colors)) {
            $this->txtColor = $txtColor;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type 'button', 'submit', 'href', 'reset'.
     *
     * @return Button
     */
    public function setType(string $type): Button
    {
        if(in_array($type, $this->types)) {
            $this->type = $type;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @param string $size 'sm' or 'lg'
     *
     * @return Button
     */
    public function setSize(string $size): Button
    {
        if($size === 'sm' || $size === 'lg') {
            $this->size = $size;
        }
        return $this;
    }

    /**
     * @return bool True for an outline button, false for a solid button.
     */
    public function isOutline(): bool
    {
        return $this->outline;
    }

    /**
     * @param bool $outline True for an outline button, false for a solid button.
     *
     * @return Button
     */
    public function setOutline(bool $outline): Button
    {
        $this->outline = $outline;
        return $this;
    }

    /**
     * @return string a link to a resource as a reference URL
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * @param string $href The href attribute defines a link to a resource as a reference URL
     */
    public function setHref(string $href): void
    {
        $this->href = $href;
    }
}