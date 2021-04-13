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
 * Class Custom
 * Custom is not a Bootstrap component, it can be used for
 * injecting client-provided HTML into a Bootstrap starter template.
 *
 * @package yellowheroes\bootwrap\libs
 */
class Custom implements libs\ComponentInterface
{
    /**
     * @var string Custom component (HTML)
     */
    private string $component = '';

    /**
     * @var array|null Injected (child) components.
     */
    private ?array $components = [];

    /**
     * @param string $html HTML to be injected inside the <body> </body> tags
     *
     * @return void
     */
    public function build(string $html = ''): void
    {
        /*
         * $html can be a user provided HTML snippet
         * or a reference to a file with a HTML snippet
         */
        if(is_file($html)) $html = file_get_contents($html);

        $custom = <<<HEREDOC
  $html\n
HEREDOC;

        $this->component = $custom;
    }

    /**
     * Injects a child component.
     *
     * A Custom component can be injected with child components (e.g. buttons).
     *
     * @param libs\ComponentInterface $component A component to be injected
     *
     */
    public function inject(libs\ComponentInterface $component): void
    {
        $this->components[] = $component->get();
    }

    /**
     * @return string   Component (HTML) built with Custom::build().
     */
    public function get(): string
    {
        return $this->component;
    }

}