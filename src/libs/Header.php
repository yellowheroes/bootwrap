<?php
/**
 * Created by Yellow Heroes
 * User: Robert
 * Date: 18/09/2018
 * Time: 15:35
 */

namespace yellowheroes\bootwrap\libs;

use yellowheroes\bootwrap\config as config;

class Header
{
    public function __construct(BootWrap $bootWrap, $components = ['theme' => null, 'tabtitle' => null])
    {
        // set extra CSS - Bootswatch-theme, Bootswatch-CSS and Bootstrap sticky footer
        $theme = $components['theme'] ?? 'slate';
        $bootSwatchCss = "https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/" . $theme . "/bootstrap.min.css";
        $stickyFooter = '../assets/css/sticky-footer-navbar.css';
        $coverNavCss = '../assets/css/cover.css';
        $scrollToTopCss = '../assets/css/scroll-to-top.css';
        $bootWrap->setStyles([$bootSwatchCss, $stickyFooter, $coverNavCss, $scrollToTopCss]);

        /* smooth scroll to anchors in articles */
        $anchors = <<<HEREDOC
        <script>
        $(document).ready(function(){
          // Add smooth scrolling to all links
          $("a").on('click', function(event) {
        
            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
              // Prevent default anchor click behavior
              event.preventDefault();
        
              // Store hash
              var hash = this.hash;
        
              // Using jQuery's animate() method to add smooth page scroll
              // The optional number (1000) specifies the number of milliseconds it takes to scroll to the specified area
              $('html, body, textarea').animate({
                scrollTop: $(hash).offset().top - 150
              }, 1000, function(){
           
                  //the following is disabled as it moves the element under the navbar again
                // Add hash (#) to URL when done scrolling (default click behavior)
                //window.location.hash = hash;
              });
            } // End if
          });
        });
        </script>
HEREDOC;

        /* the scroll-to-top jquery animation */
        $scrollToTop = <<<HEREDOC
        <script>
        $(document).ready(function(){ 
            $(window).scroll(function(){ 
                if ($(this).scrollTop() > 100) { 
                    $('#scroll').fadeIn(); 
                } else { 
                    $('#scroll').fadeOut(); 
                } 
            }); 
            $('#scroll').click(function(){ 
                $("html, body").animate({ scrollTop: 0 }, 600); 
                return false; 
            }); 
        });
        </script>
HEREDOC;
        /*
         * activate code higlighting with highlight.js
         * any <pre><code> </code></pre> block will be
         * code highlighted using the set theme.
         */
        $theme = new config\Config();
        $theme = $theme::HIGHLIGHTJS_THEME; // the theme is set in Config.php
        //$theme = "atom-one-dark"; // code highlighting theme for highlight.js
        $highlightJs = <<<HEREDOC
        <!-- code higlighting with highlightjs -->
        <link rel="stylesheet" href="../assets/css/highlightjs_styles/$theme.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/highlight.min.js"
        integrity="sha256-iq71rXEe/fvjCUP9AfLY0cKudQuKAQywiUpXkRFSkLc=" crossorigin="anonymous"></script>
        <script>hljs.initHighlightingOnLoad();</script>
HEREDOC;

        $bootWrap->setJs([$highlightJs, $anchors, $scrollToTop]);
        $title = $components['tabtitle'] ?? 'BootWrap';
        $head = $bootWrap->head($title);
        echo $head;
        echo "<!-- end HTML generation class Head -->\n";

        /* open the <body> block - is closed by Footer.php */
        echo "<!-- start class Body generated HTML -->\n";
        echo "<body>\n";
        echo "<main role='main' class='container'>\n";
    }

}
