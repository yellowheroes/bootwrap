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
    public string $html = ''; // container stores footer HTML - is retrieved by BootWrap::inject()

    /**
     * Set the document footer
     *
     * The footer can be constructed to contain hyperlinks.
     *
     * format:
     *          ['category title' => ['display txt' => 'linked doc', 'display txt' => 'linked doc'],]
     *
     *          e.g. [
     *                'general' => ['contact us' => 'home.php', 'about us' => 'about.php'],
     *                'api' => ['documentation' => 'docs.php'],
     *               ]
     *
     * @param string $copyRight    copyright message
     * @param array  $hrefs        hypertext links
     * @param string $imageSrcPath image src path (e.g. logo)
     *
     * @return string
     */
    public function build(string $copyRight = 'organisation', array $hrefs = [], string $imageSrcPath = ''): string
    {
        $footerHtml = '';
        /* set default: copyright symbol and year */
        $copyRightSymbol = " &#169 ";
        $copyRightYear = date("Y");
        $copyRight = $copyRight . $copyRightSymbol . $copyRightYear; // append Copyright notice: c YYYY - to footer content

        /* construct the href - text-links - block */
        $links = '';
        $image = ($imageSrcPath !== '') ? "<img class='float-right' src='$imageSrcPath' width='48px' height='48' style='margin: 10px;'>" : ''; // logo
        if (!empty($hrefs)) {
            $links = "<div class='row'>";
            $links .= "<div class='col'>$image</div>"; // logo
            foreach ($hrefs as $title => $textLink) { // each href list-block can have a header-title
                $links .= "<div class='col'>"; // start div-column for each list-block of hrefs
                foreach ($textLink as $display => $link) { // the actual links
                    $title = $title ?? '';
                    $title = strtoupper($title);
                    $href = $this->href($link, $display);
                    $links .= <<<HEREDOC
            $title
            <ul class="list-unstyled quick-links" style="line-height: 10px; font-size: 0.8em;">
            <li class="text-left">
            $href
            </li>
            </ul>\n
HEREDOC;
                    $title = null; // render title only once for each block or category of hrefs
                }
                $links .= "</div>"; // end div-column for a list-block of hrefs
            }
            $links .= "</div>"; // end div-row - all hypertext link blocks are generated
        }
        $links = ($links !== '') ? "<div class='text-muted' style='color: #FFFFFF !important;'>$links</div><div><br /></div>" : '';

        $footerHtml = <<<HEREDOC
<footer class="footer" style="margin-top: 80px;">
    <div class="container-fluid bg-dark">
    <!-- <div><hr class="bg-primary"/></div> -->
        $links
        <div class="text-muted text-center" style="color: #FFFFFF !important;">$copyRight</div>
    </div>
</footer>\n
HEREDOC;

        $this->html = $footerHtml;
        return $footerHtml;
    }
}