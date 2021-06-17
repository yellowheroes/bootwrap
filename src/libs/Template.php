<?php
/**
 * Created by Yellow Heroes
 * Project: scratchpad
 * File: Template.php
 * User: Robert
 * Date: 9/6/2020
 * Time: 21:54
 */

namespace yellowheroes\bootwrap\libs;

use yellowheroes\bootwrap\config\Config;

class Template
{
    private ?object $config;
    private string $template = ''; // path to template
    private ?array $vars = [];

    public function __construct(string $template, array $vars = [])
    {
        $this->config = new Config();
        $templates = $this->config->getPaths()['templates']; // templates dir
        $this->template = $templates . $template;
        $this->vars = $vars;
    }

    /**
     * @return string The resolved template (HTML)
     */
    public function resolve(): string
    {
        ob_start(); // start output buffering
        if (file_exists($this->template)) {
            // extract() template variables to current scope
            extract($this->vars);

            // import the template HTML and inject(resolve) template variables
            include($this->template);
        }
        return ob_get_clean(); // remove buffer and return resolved template.
    }
}