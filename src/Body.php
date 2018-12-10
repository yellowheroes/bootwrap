<?php
/**
 * Created by Yellow Heroes
 * User: Robert
 * Date: 18/09/2018
 * Time: 15:35
 */

namespace yellowheroes\bootwrap;

class Body
{
    /* all components defined in class BootWrap */
    protected $bootWrapComponents = ['alert', 'card', 'carousel', 'form', 'jumbotron', 'modal', 'navbar'];

    public function __construct(BootWrap $bootWrap, array $components = [])
    {
        echo "<!-- start class Body generated HTML -->\n";
        echo "<body>";
        echo "<header><nav></nav></header>";
        echo "<main role='main' class='container'>";

        /* render all requested components */
        return $this->renderComponents($bootWrap, $components);
    }

    protected function renderComponents(BootWrap $bootWrap, array $components = []): bool
    {
        $this->bootWrapComponents = array_flip($this->bootWrapComponents); // each value (component name) in the list becomes a key
        foreach ($components as $component => $params) {
            /* verify if the component exists / whitelisted */
            if(array_key_exists($component, $this->bootWrapComponents)) {
                $componentHtml = call_user_func_array([$bootWrap, $component], $params);
                echo $componentHtml;
            } else {
                // Component does not exist in BootWrap
                return true; // error
            }
        }
        return false; // all ok
    }

}
