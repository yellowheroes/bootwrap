<?php
/**
 * Created by Yellow Heroes
 * User: Robert
 * Date: 18/09/2018
 * Time: 15:35
 */

namespace yellowheroes\bootwrap\libs;

class Body
{
    /* whitelist of components defined in class BootWrap */
    protected $bootWrapComponents = ['alert', 'card', 'carousel', 'form', 'jumbotron', 'modal', 'navbar'];

    //public function __construct(BootWrap $bootWrap, array $components = [])
    public function __construct()
    {
        /* render requested components */
        //return $this->render($bootWrap, $components); // returns false if no error(s)
    }

    /**
     * @param BootWrap $bootWrap
     * @param array $components                        component name                           component parameters
     *                              e.g.: $components = ['jumbotron' => array('BootWrap', 'Bootstrap components made easy', 'enjoy the ride')];
     *
     * @return bool|null
     */
    public function render(BootWrap $bootWrap, array $components = []): bool
    {
        $flipped = array_flip($this->bootWrapComponents); // each value (component name) in the list becomes a key
        foreach ($components as $component => $params) {
            /* verify if the component exists / is whitelisted */
            if(array_key_exists($component, $flipped)) {
                $componentHtml = call_user_func_array([$bootWrap, $component], $params);
                if($component === 'navbar') {
                    echo "<header>";
                    echo $componentHtml; // render navbar
                    echo "</header>";
                } else {
                    echo $componentHtml; // render component
                }
            } else {
                // Component does not exist in BootWrap
                return true; // error
            }
        }
        return false; // all ok
    }

}
