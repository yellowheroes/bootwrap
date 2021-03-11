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

class Alert implements ComponentInterface
{
    public string $html = ''; // container to store the built alert-component HTML

    /**
     * @param string    $msg        : the message to be displayed in the alert box
     * @param string    $type       : 'info', 'primary', 'secondary', 'warning', 'danger', 'success', 'light'
     * @param bool      $dismiss    : if set to false, the alert cannot be dismissed.
     * @param int|null  $zIndex     : overlapping elements with a larger z-index cover those with a smaller one.
     * @param string    $textColor  : Bootstrap color classes: 'primary' for 'text-primary', 'secondary' for 'text-secondary' etc.
     *
     * @return string               : Bootstrap alert component html
     */
    public function build(string $msg = '', string $type = 'info', bool $dismiss = true, int $zIndex = null, $textColor = ''): string
    {
        $buttonHtml = <<<HEREDOC
<button type="button" class="close" data-dismiss="alert">&times;</button>
HEREDOC;
        $dismissible = ($dismiss === true) ? "alert-dismissible" : '';
        $button = ($dismiss === true) ? $buttonHtml : '';
        $z = ($zIndex !== null) ? "style='z-index: $zIndex;'" : '';
        $textColor = ($textColor !== '') ? 'text-' . $textColor : '';
        $alertHtml = <<<HEREDOC
  <div class="bs-component col-sm-10 alert $textColor $dismissible alert-$type" $z>
  $button
  $msg
  </div>
HEREDOC;

        $this->html = $alertHtml;

        return $alertHtml;
    }
}