<?php
/**
 * Created by Yellow Heroes
 * User: Robert
 * Date: 18/09/2018
 * Time: 15:35
 */
namespace yellowheroes\bootwrap;

class Head
{
    public function __construct(BootWrap $bootWrap, $components = ['theme' => null, 'tabtitle' => null])
    {
        // set extra CSS - Bootswatch and sticky footer
        $theme = $components['theme'] ?? 'slate';
        $bootSwatchCss = "https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/" . $theme . "/bootstrap.min.css";
        $stickyFooter = './sticky-footer-navbar.css';
        $bootWrap->setStyles([$bootSwatchCss, $stickyFooter]);

        $title = $components['title'] ?? 'BootWrap';
        $head = $bootWrap->head($title);
        echo $head;
        echo "<!-- end HTML generation class Head -->\n";
    }

}
