<?php
/**
 * Created by Yellow Heroes
 * User: Robert
 * Date: 18/09/2018
 * Time: 15:35
 */

namespace yellowheroes\bootwrap\libs;

use yellowheroes\bootwrap\config as config;

class Head
{
    public function __construct(BootWrap $bootWrap, $components = ['theme' => null, 'tabtitle' => null])
    {
        // set extra CSS - Bootswatch-theme, Bootswatch-CSS and Bootstrap sticky footer
        $theme = $components['theme'] ?? 'slate';
        $bootSwatchCss = "https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/" . $theme . "/bootstrap.min.css";
        $stickyFooter = '../assets/css/sticky-footer-navbar.css';
        $highlightJsCss = '../assets/css/highlightjs_styles/default.css';
        $bootWrap->setStyles([$bootSwatchCss, $stickyFooter]);

        /*
         * activate code higlighting with highlight.js
         * any <pre><code> </code></pre> block will be
         * code highlighted using the set theme.
         */
        $theme = "atom-one-dark"; // code highlighting theme for highlight.js
        $highlightJs = <<<HEREDOC
        <!-- code higlighting with highlightjs -->
        <link rel="stylesheet" href="../assets/css/highlightjs_styles/$theme.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/highlight.min.js"
        integrity="sha256-iq71rXEe/fvjCUP9AfLY0cKudQuKAQywiUpXkRFSkLc=" crossorigin="anonymous"></script>
        <script>hljs.initHighlightingOnLoad();</script>
HEREDOC;

        $bootWrap->setJs([$highlightJs]); // activate code highlighting
        $title = $components['tabtitle'] ?? 'BootWrap';
        $head = $bootWrap->head($title);
        echo $head;
        echo "<!-- end HTML generation class Head -->\n";
    }

}
