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

interface FormInterface
{
    /**
     * Each form element class (e.g. FormText, FormEmail, FormPassword, FormSelect, FormRadio...etc.)
     * MUST implement a build() method that constructs and returns the required Bootstrap HTML
     *
     * @return string   : form element html
     */
    public function build(): string;
}