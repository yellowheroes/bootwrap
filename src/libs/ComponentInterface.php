<?php
/**
 * Created by Yellow Heroes
 * Project: bootwrap
 * File: ComponentInterface.php
 * User: Robert
 * Date: 8/22/2020
 * Time: 23:53
 */
declare(strict_types=1);

namespace yellowheroes\bootwrap\libs;

/**
 * Describes the interface of a component that exposes methods to inject
 * construct and retrieve a component.
 *
 * @package yellowheroes\bootwrap\libs
 */
interface ComponentInterface
{
    /**
     * @param ComponentInterface $component Injects a (child) component
     */
    public function inject(ComponentInterface $component): void;

    /**
     * Constructs Bootstrap component HTML.
     */
    public function build(): void;

    /**
     * Retrieves Bootstrap component HTML.
     *
     * @return string   Component HTML.
     */
    public function get(): string;
}