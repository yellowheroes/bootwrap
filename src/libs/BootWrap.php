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

use yellowheroes\bootwrap\config\Config;
use yellowheroes\bootwrap\libs\components\Footer;
use yellowheroes\bootwrap\libs\components\Navbar;

class BootWrap
{
    private ?object $config = null; // access to core config
    private string $htmlOpen = ''; // opening block html5 page
    private string $meta = ''; // html meta-data
    private string $styles = ''; // CSS stylesheets (in <head>)
    private string $title = ''; // browser tab title
    private string $header = ''; // header block
    private string $libs = ''; // Bootstrap libraries, other Javascript libraries
    private string $otherJs = ''; // other javascript snippets (optional)
    private string $htmlClose = ''; // closing block html5 page
    private array $components = []; // container for client-set Bootstrap components
    private string $footer = ''; // footer block (optional)
    private string $navBar = ''; // navigation bar (optional)
    private string $navCss = ''; // see - https://stackoverflow.com/questions/11124777/twitter-bootstrap-navbar-fixed-top-overlapping-site

    /**
     * Creates a minimum default Bootstrap starter template (HTML).
     *
     * use BootWrap::inject() to inject components into the starter template.
     * The starter template, with/without injected components, can be rendered
     * using BootWrap::render().
     */
    public function __construct()
    {
        $this->config = new Config();
        $this->setHtmlOpen();
        $this->setMeta();
        $this->setStyles();
        $this->setTitle();
        $this->setLibs();
        $this->setHtmlClose();
    }

    /**
     * Constructs a Bootstrap enabled page [with injected components].
     *
     * Returns the minimum required Bootstrap HTML (starter template)
     * including any user-injected Bootstrap components, stylesheets,
     * libraries.
     * (for more on components:
     * https://getbootstrap.com/docs/5.0/components/alerts/)
     *
     * @return string A Bootstrap HTML page (starter template + injected
     *                components).
     */
    public function render(): string
    {
        /*
         * Process injected (child) components - build HTML
         *
         * Each element in array $this->components[] contains a Bootstrap component(HTML)
         * and is rendered inside the page's <main>...</main> block.
         *
         * There are two exceptions:
         * - the Navbar component is rendered inside the <header>...</header> block.
         * - the Footer component is rendered outside the <main>...</main> block.
         *
         * Navbar is assigned key 'navbar' and Footer key 'footer' when stored in $this->components[].
         * We use these associative keys to filter for them and process them separately,
         * so they are rendered in the correct location.
         */
        $components = '';
        if (!empty($this->components)) {
            foreach ($this->components as $key => $component) {
                if ($key === 'footer') {
                    $this->footer = $component . "\n"; // add footer
                } elseif ($key === 'navbar') {
                    $this->navBar = $component . "\n"; // add navbar
                } else $components .= $component . "\n"; // add other components
            }
        }

        // build the page
        $page = <<<HEREDOC
$this->htmlOpen
 <head>
    $this->meta
    
    $this->styles     
    $this->title
 </head>
 <body>\n
    <header class="page-header">\n$this->navBar\t</header>\n
    <main class="page-body">\n$components\t</main>\n
    $this->footer
    $this->libs
    $this->otherJs
    
$this->htmlClose
HEREDOC;
        return $page;
    }

    /**
     * Injects Bootstrap component into the Bootstrap (template) HTML page
     *
     * Navbar & Footer components are injected outside <main>...</main> block.
     * - Navbar component is keyed 'navbar', as it MUST be built inside the
     * <header> block.
     * - Footer component is keyed 'footer', as it MUST be built outside the
     * <main> block.
     *
     * These associative keys allow us to identify / process these components
     * in BootWrap::build()
     *
     * @param ComponentInterface $component
     *
     * @return void
     */
    public function inject(ComponentInterface $component): void
    {
        if ($component instanceof Footer) {
            if ($component->isSticky()) {
                $sticky = $this->config->getPaths()['css'] .
                    'sticky-footer.css';
                $this->setStyles([$sticky]); // set sticky footer
            }
            $this->components['footer'] = $component->get();
        } elseif ($component instanceof Navbar) {
            $this->components['navbar'] = $component->get();
        } else $this->components[] = $component->get();
    }

    /**
     * @return string
     */
    public function getHtmlOpen(): string
    {
        return $this->htmlOpen;
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
     * @return string
     */
    public function getHtmlClose(): string
    {
        return $this->htmlClose;
    }

    /**
     * build the closing block for a html5 page
     *
     * @return void
     */
    public function setHtmlClose(): void
    {
        $this->htmlClose = <<<HEREDOC
 </body>
</html>
HEREDOC;
    }

    /**
     * @return string
     */
    public function getMeta(): string
    {
        return $this->meta;
    }

    /**
     * Sets the required html meta tags (in <head> block).
     *
     * @return void
     */
    public function setMeta(): void
    {
        $this->meta = <<<HEREDOC
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
HEREDOC;
    }

    /**
     * @return string
     */
    public function getStyles(): string
    {
        return $this->styles;
    }

    /**
     * Sets CSS stylesheets (in <head> block)
     *
     * Default (Bootstrap) CSS is automatically set.
     * Client can add supplementary CSS sheets by calling this function
     * directly.
     *
     * @param array $styleSheets path to each style sheet
     *
     * @return void
     */
    public function setStyles(array $styleSheets = []): void
    {
        // default CSS (set on BootWrap instantiation)
        if (empty($styleSheets)) {
            $this->styles = <<<HEREDOC
<!-- Bootstrap5 and 'other' CSS -->
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
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets the document title that will be shown on the browser-tab
     *
     * @param string $title defaults to 'Bootwrap'
     *
     * @return void
     */
    public function setTitle(string $title = 'Bootwrap'): void
    {
        $this->title = <<<HEREDOC
<title>$title</title>
HEREDOC;
    }

    /**
     * @return string
     */
    public function getLibs(): string
    {
        return $this->libs;
    }

    /**
     * Sets libraries (Javascript).
     *
     * Upon BootWrap object instantiation the default libs are automatically
     * set. Client can add supplementary libs by calling this function
     * directly.
     *
     * @param array $libs
     *
     * @return void
     */
    public function setLibs(array $libs = []): void
    {
        // set default Bootstrap libraries
        if (empty($libs)) {
            $this->libs = <<<HEREDOC
<!-- Bootstrap5 and 'other' Javascript libraries-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>\n
HEREDOC;
        } else {
            // additional Javascript libraries
            foreach ($libs as $lib) {
                $this->libs .= <<<HEREDOC
    <script src="$lib"></script>\n
HEREDOC;
            }
        }
    }

    /**
     * @return string
     */
    public function getOtherJs(): string
    {
        return $this->otherJs;
    }

    /**
     * Set complementary javascript snippet - anything that's not a full-blown
     * library
     *
     * @param string $other : complementary JavaScript (e.g. for modal to
     *                      function)
     *
     * @return void
     */
    public function setOtherJs(string $other): void
    {
        $this->otherJs .= <<<HEREDOC
<!-- JavaScript snippets -->
$other\n
HEREDOC;
    }
}