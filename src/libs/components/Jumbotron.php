<?php
/**
 * Created by Yellow Heroes
 * Project: bootwrap
 * File: Alert.php
 * User: Robert
 * Date: 8/22/2020
 * Time: 21:57
 */
declare(strict_types=1);

namespace yellowheroes\bootwrap\libs;

class Jumbotron implements ComponentInterface
{
    public string $html = ''; // container stores jumbotron-component HTML - is retrieved by BootWrap::inject()

    /**
     * @param string|null $title
     * @param string|null $subTitle
     * @param string|null $msg
     * @param array|null $button        : set ['href' => '...', 'display' => '...']
     *
     * @return string                   : Bootstrap jumbotron component html
     */
    public function build(?string $title = null, ?string $subTitle = null, ?string $msg = null, $button = []): string
    {
        $jumbotronHtml = '';

        // if button, get display msg and href
        $href = '';
        $display = '';
        if(!empty($button['href']) && !empty($button['display'])) {
            $href = $button['href'] ?? '';
            $display = $button['display'] ?? '';
        }

        $jumbotronOpen = <<<HEREDOC
    <div class="jumbotron">
      <h1 class="display-3">$title</h1>
      <p class="lead">$subTitle</p>
      <hr class="my-4">
      <p>$msg</p>\n
HEREDOC;

        $jumbotronButton = <<<HEREDOC
      <p class="lead">
      <a class="btn btn-primary btn-lg" href="$href" role="button">$display</a>
      </p>
HEREDOC;

        $jumbotronClose = <<<HEREDOC
    </div>\n
HEREDOC;

        $jumbotronButton = (!empty($button)) ? $jumbotronButton : '';
        $jumbotronHtml = $jumbotronOpen . $jumbotronButton . $jumbotronClose;

        $this->html = $jumbotronHtml;
        return $jumbotronHtml;
    }
}