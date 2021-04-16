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
    private string $tmplPath = ''; // path to template

    public function __construct(string $template, array $vars = [])
    {
        $this->config = new Config();
        $templates = $this->config->getPath()['templates'];
        $this->tmplPath = $templates . $template;
    }

    /**
     * @param $filename     : the template file name (i.e. in views directory: sometemplate.tmpl.php)
     *
     * @return false|string : returns the template file with resolved variables (returns false if output buffering isn't active)
     */
    public function build(string $filename = ''): string
    {
        ob_start(); // start output buffering, so we can return template content without printing it.
        if (file_exists($this->tmplPath . $filename)) {
            /*
             * extract() extracts variables to current scope.
             * The variables can now be resolved(injected) inside the html template
             */
            extract($this->properties);

            /* import the template HTML and inject(resolve) available variables */
            include($this->viewsPath . $filename);

            /* import footer HTML and inject(resolve) available variables */
            if($this->footer) {
                include($this->viewsPath . self::TEMPLATE_FOOTER);
            }
        } else {
            echo 'error: template not found';

        }
        return ob_get_clean(); // remove the buffer (without printing it), and return its content.
    }

    // dynamically read data from properties that have not been declared or are not visible
    public function __get($name)
    {
        return $this->properties[$name];
    }

    // dynamically create / write data to properties that have not been declared (or are not visible)
    public function __set($name, $value)
    {
        $this->properties[$name] = $value; // add property
    }
}