<?php
/**
 * Created by Yellow Heroes
 * User: Robert
 * Date: 18/09/2018
 * Time: 15:35
 */
namespace yellowheroes\bootwrap;

class Header
{
    public function __construct()
    {
        $bootWrap = new BootWrap();

        // set extra CSS - Bootswatch and sticky footer
        $theme = 'slate';
        $bootSwatchCss = "https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/" . $theme . "/bootstrap.min.css";
        $stickyFooter = './sticky-footer-navbar.css';
        $bootWrap->setStyles([$bootSwatchCss, $stickyFooter]);

        $head = $bootWrap->head('yoohoo');
        echo $head;
        echo "<!-- end HTML generation class Header -->\n";
    }

}
