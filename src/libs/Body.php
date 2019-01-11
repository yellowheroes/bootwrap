<?php
/**
 * Created by Yellow Heroes
 * User: Robert
 * Date: 18/09/2018
 * Time: 15:35
 */

namespace yellowheroes\bootwrap\libs;
/**
 * Class Body
 *
 * @package yellowheroes\bootwrap\libs
 */
class Body
{
    /**
     * if a component is not in the whitelist, it won't get rendered.
     * @var array $whiteList   : whitelist of (working) components defined in class BootWrap
     */
    protected $whiteList = ['alert', 'card', 'carousel', 'form', 'jumbotron', 'modal', 'navbar'];

    /**
     * Body constructor.
     */
    public function __construct()
    {
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
        foreach ($components as $component => $params) {
            /* verify if the component exists / is whitelisted */
            if(in_array($component, $this->whiteList, true)) {
                $componentHtml = call_user_func_array([$bootWrap, $component], $params);
                if($component === 'navbar') {
                    echo "<header>";
                    echo $componentHtml; // render navbar
                    echo "</header>";
                } else {
                    echo "<div class='row'>";
                    echo $componentHtml; // render component
                    echo "</div>";
                }
            } else {
                // Component does not exist in BootWrap
                return true; // error
            }
        }
        return false; // all ok
    }

}
