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
 * Class Alert
 *
 * Provide contextual feedback messages for typical user actions
 *
 * @package yellowheroes\bootwrap\libs\components
 */
class Alert implements libs\ComponentInterface
{
    /**
     * @var string Bootstrap Alert component (HTML).
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
    private string $padding = '3';
    private string $rounded = '3';
    private string $margin = '3';
    private string $rulerMargin = '4';
    private ?string $customClass = null; // set your proprietary css classes

    public function build(
        ?string $msg = '',
        ?bool $dismiss = true,
        ?int $zIndex = null
    ): void {
        // Injected (child) components - build HTML
        $components = '';
        if (!empty($this->components)) {
            foreach ($this->components as $component) {
                $components .= $component . "\n";
            }
        }

        // create Alert
        $dismissBtn = <<<HEREDOC
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
HEREDOC;
        $dismissible = ($dismiss === true) ? "alert-dismissible" : '';
        $button = ($dismiss === true) ? $dismissBtn : '';
        $z = ($zIndex !== null) ? "style='z-index: $zIndex;'" : '';
        $alert = <<<HEREDOC
<div class="$this->customClass alert text-$this->txtColor alert-$this->bgColor $dismissible fade show" role="alert" $z>
  $msg
  $button
  $components
</div>
HEREDOC;

        // store Alert
        $this->component = $alert;
    }

    /**
     * Injects a child component.
     *
     * An Alert can be injected with child components (e.g. buttons).
     *
     * @param libs\ComponentInterface $component A component to be injected
     *
     */
    public function inject(libs\ComponentInterface $component): void
    {
        $this->components[] = $component->get();
    }

    /**
     * @return string   Component (HTML) built with Alert::build().
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
    public function setBgColor(string $bgColor): Alert
    {
        $this->bgColor = $bgColor;
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
    public function setTxtColor(string $txtColor): Alert
    {
        $this->txtColor = $txtColor;
        return $this;
    }
}