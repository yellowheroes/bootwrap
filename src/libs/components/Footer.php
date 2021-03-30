<?php
/**
 * Created by Yellow Heroes
 * Project: bootwrap
 * File: Footer.php
 * User: Robert
 * Date: 8/22/2020
 * Time: 21:57
 */
declare(strict_types=1);

namespace yellowheroes\bootwrap\libs\components;

use yellowheroes\bootwrap\libs as libs;

class Footer implements libs\ComponentInterface
{
    /**
     * @var string Footer HTML
     */
    private string $component = '';

    /**
     * @var array|null Injected (child) components.
     */
    private ?array $components = [];

    // default config
    private array $colors = [
        'primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light',
        'dark', 'body', 'muted', 'white', 'black-50', 'white-50', 'off',
    ];
    private bool $sticky = true; // true for sticky footer
    private string $bgColor = 'dark';
    private string $txtColor = 'white';
    private string $txtSize = '0.8em';
    private string $lineHeight = '20px';
    private string $padding = '0';
    private string $margin = '0';
    private ?string $customClass = null; // set your proprietary css

    /**
     * Builds a Footer component.
     *
     * The footer can be constructed to contain headers and hyperlinks.
     *
     * $hrefs[] format:
     *          ['header' => ['display txt' => 'linked resource'], ...]
     *
     *          e.g.
     *          [
     *           'general' => ['contact' => 'contact.php', 'about' =>
     *           'about.php'],
     *           'api' => ['documentation' => 'docs.php'],
     *          ]
     *
     * @param string $org Organisation
     * @param array  $hrefs Hypertext links (groups)
     * @param string $image Path to image (e.g. logo)
     *
     * @return void
     */
    public function build(
        string $org = 'organisation',
        array $hrefs = [],
        string $image = ''
    ): void {
        // set default copyright symbol and year
        $copyRightSymbol = " &#169; ";
        $copyRightYear = date("Y");
        $copyRight = $org . $copyRightSymbol . $copyRightYear;

        // construct the footer
        $links = '';
        $image = ($image !== '') ?
            "<img class='float-right' src='$image' width='48px' height='48' style='margin: 10px;'>" :
            null;
        if (!empty($hrefs)) {
            $links = "<div class='row' style='line-height: $this->lineHeight; font-size: $this->txtSize;'>";
            //$links .= ($image !== '') ? '<div class="col-sm">' . $image . '</div>' : '';
            $links .= '<div class="col-sm">' . $image . '</div>';
            foreach ($hrefs as $header => $href) {
                $links .= '<div class="col-sm">';
                $links .= (is_string($header)) ? $header : '';
                $links .= '<br /><br />';
                foreach ($href as $display => $uri) {
                    $lnk = new Link();
                    $lnk->build($uri, $display);
                    $links .= $lnk->get(); // hypertext link
                    $links .= '<br />';
                }
                $links .= '</div>'; // close column
            }
            $links .= '</div>'; // close row
        }

        $footer = <<<HEREDOC
<footer class="$this->customClass page-footer bg-$this->bgColor text-$this->txtColor p-$this->padding m-$this->margin">
    <div class="container-fluid">
        $links
        <div class="text-muted text-center p-3" style="color: #FFFFFF !important; font-size: 0.8em;">$copyRight</div>
    </div>
\t</footer>\n
HEREDOC;

        // store Footer
        $this->component = $footer;
    }

    /**
     * Injects a child component.
     *
     * A Footer can be injected with child components.
     *
     * @param libs\ComponentInterface $component A component to be injected
     *
     */
    public function inject(libs\ComponentInterface $component): void
    {
        $this->components[] = $component->get();
    }

    /**
     * @return string   Component (HTML) built with Footer::build().
     */
    public function get(): string
    {
        return $this->component;
    }

    /**
     * @return bool true = footer sticks to bottom of viewport and scrolls down
     */
    public function isSticky(): bool
    {
        return $this->sticky;
    }

    /**
     * @param bool $sticky true = footer sticks to bottom of viewport
     */
    public function setSticky(bool $sticky): void
    {
        $this->sticky = $sticky;
    }
}