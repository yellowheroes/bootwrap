<?php
/**
 * Created by Yellow Heroes
 * Project: bootwrap
 * File: BootWrap.php
 * User: Robert
 * Date: 8/22/2020
 * Time: 15:00
 */
declare(strict_types=1);

namespace yellowheroes\bootwrap\libs;

class BootWrap
{
    private string $htmlOpen = ''; // opening block html5 page
    private string $meta = ''; // html meta-data
    private string $styles = ''; // CSS stylesheets (in <head>)
    private string $title = ''; // browser tab title
    private string $footer = ''; // footer block
    private string $libs = ''; // Bootstrap libraries, other javascript libraries
    private string $otherJs = ''; // other javascript
    private string $htmlClose = ''; // closing block html5 page
    private array $components = []; // container for client-set Bootstrap components (rendered when BootWrap::render() is invoked)
    private string $bsNavBarHack = ''; // see - https://stackoverflow.com/questions/11124777/twitter-bootstrap-navbar-fixed-top-overlapping-site

    /**
     * Creates a minimum default Bootstrap starter template (HTML).
     *
     * If you want to inject components into the starter template, use BootWrap::inject().
     * The starter template, with/without injected components, can then be rendered using BootWrap::render().
     */
    public function __construct()
    {
        $this->setHtmlOpen();
        $this->setMeta();
        $this->setStyles();
        $this->setTitle();
        $this->setLibs();
        $this->setHtmlClose();
    }

    /**
     * build the opening block for a html5 page
     *
     * @return void
     */
    public function setHtmlOpen(): void
    {
        $this->htmlOpen = <<<HEREDOC
<!doctype html>
<html lang="en">
HEREDOC;
    }

    /**
     * build the closing block for a html5 page
     *
     * @return void
     */
    public function setHtmlClose(): void
    {
        $this->htmlClose = <<<HEREDOC
</html>
HEREDOC;
    }

    /**
     * set the required html meta tags (in <head> block)
     *
     * @return void
     */
    public function setMeta(): void
    {
        $this->meta = <<<HEREDOC
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
HEREDOC;
    }

    /**
     * Set CSS stylesheets (in <head> block)
     *
     * Default (Bootstrap) CSS is automatically set.
     * Client can add supplementary CSS sheets by calling this function directly.
     *
     * @param array $styleSheets    :path to each style sheet
     *
     * @return void
     */
    public function setStyles(array $styleSheets = []): void
    {
        // default CSS (set on BootWrap instantiation)
        if (empty($styleSheets)) {
            $this->styles = <<<HEREDOC
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">\n
HEREDOC;
        } else {
            // client can add additional CSS
            foreach ($styleSheets as $css) {
                $this->styles .= <<<HEREDOC
    <link rel="stylesheet" href="$css">\n
HEREDOC;
            }
        }
    }

    /**
     * Set libraries that MUST be referenced to enable Bootstrap
     *
     * MUST require jQuery, Popper.js, and Bootstrap's own JavaScript plugins (in that order).
     * Placed near the end of your page right before the closing </body> tag, to enable them.
     *
     * Upon BootWrap object instantiation the default libs are automatically set.
     * Client can add supplementary JS libs by calling this function directly.
     *
     * @param array $libs
     *
     * @return void
     */
    public function setLibs(array $libs = []): void
    {
        // set default libraries (Bootstrap5 no longer requires JQuery)
        if (empty($libs)) {
            $this->libs = <<<HEREDOC
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
\n
HEREDOC;
        } else {
            // client can add additional JS libraries
            foreach ($libs as $lib) {
                $this->libs .= <<<HEREDOC
    <script src="$lib"></script>\n
HEREDOC;
            }
        }
    }

    /**
     * Set complementary javascript snippets - anything that's not a full-blown library
     *
     * @param string $other    : complementary JavaScript (e.g. for modal to function)
     *
     * @return void
     */
    public function setOtherJs(string $other): void
    {
        $this->otherJs .= <<<HEREDOC
$other\n
HEREDOC;
    }

    /**
     * set the document title that will be shown on the browser-tab
     *
     * @param string $title    : defaults to 'bootwrap'
     *
     * @return void
     */
    public function setTitle(string $title = 'bootwrap'): void
    {
        $this->title = <<<HEREDOC
<title>$title</title>
HEREDOC;
    }

    /**
     * @param null   $link
     * @param string $display
     * @param string $class
     * @param null   $cssClass
     *
     * @return string
     */
    public function href($link = null, $display = 'click me', $class = 'primary', $cssClass = null)
    {
        $hrefHtml = '';
        $hrefHtml = <<<HEREDOC
       <span class="$cssClass"><a href="$link">$display</a></span>
HEREDOC;
        return $hrefHtml;
    }

    /**
     * Construct a Bootstrap enabled page
     *
     * render() returns the minimum required Bootstrap HTML (starter template)
     * plus any user-set Bootstrap components, stylesheets, libs etc.
     * (for more on components: https://getbootstrap.com/docs/4.5/components/)
     *
     * @return string                   : a Bootstrap HTML page (starter template + components)
     */
    public function render(): string
    {
        /*
         * build Bootstrap components HTML
         * each element in $this->components(array) holds Boostrap HTML for a component
         * we concatenate all of the components HTML and store them in container(string) $components.
         *
         * The components are rendered inside <body></body>
         */
        $components = '';
        if(!empty($this->components)) {
            foreach($this->components as $component) {
                $components .= $component . "\n"; // build HTML
            }
        }

        // bsnavbarhack - sets the necessary <body> padding for navbar
        // see https://stackoverflow.com/questions/11124777/twitter-bootstrap-navbar-fixed-top-overlapping-site
        $page = <<<HEREDOC
$this->htmlOpen
 <head>
    <!-- Required meta tags -->
    $this->meta
    
    <!-- Bootstrap5 and 'other' CSS -->
    $this->styles
        
    $this->title
 </head>
 <body class="wrapper" $this->bsNavBarHack>\n
$components

    <!-- Bootstrap5: JavaScript Bundle with Popper and 'other' js libs-->
    $this->libs
    <!-- other JavaScript snippets (e.g. for modal component) -->
    $this->otherJs
    $this->footer
 </body>
$this->htmlClose
HEREDOC;
        return $page;
    }

    /**
     * @return string
     */
    public function getHtmlOpen(): string
    {
        return $this->htmlOpen;
    }

    /**
     * @return string
     */
    public function getMeta(): string
    {
        return $this->meta;
    }

    /**
     * @return string
     */
    public function getStyles(): string
    {
        return $this->styles;
    }

    /**
     * @return string
     */
    public function getLibs(): string
    {
        return $this->libs;
    }

    /**
     * @return string
     */
    public function getOtherJs(): string
    {
        return $this->otherJs;
    }

    /**
     * @return string
     */
    public function getFooter(): string
    {
        return $this->footer;
    }

    /**
     * Inject Bootstrap component into the Bootstrap (template) HTML page
     *
     * @param ComponentInterface $component
     *
     * @return void
     */
    public function inject(ComponentInterface $component): void
    {
        $this->components[] = $component->html;
    }
}