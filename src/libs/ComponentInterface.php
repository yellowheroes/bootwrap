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

interface ComponentInterface
{
    /**
     * Each Bootstrap component must implement a build method
     * that constructs and returns the required Bootstrap HTML
     *
     * Each component MUST store the build() HTML in a property called html
     *
     * @return string   : Bootstrap component html
     */
    public function build(): string;
}