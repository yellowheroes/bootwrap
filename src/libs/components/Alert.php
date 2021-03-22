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

namespace yellowheroes\bootwrap\libs\components;

use yellowheroes\bootwrap\libs as libs;

/**
 * Class Alert
 *
 * Provide contextual feedback messages for typical user actions
 *
 * @package yellowheroes\bootwrap\libs\components
 */
class Alert implements libs\ComponentInterface
{
    public string $html = ''; // Bootstrap Alert component (HTML)

    /**
     * @param ?string    $msg        : the message to be displayed in the alert box
     * @param ?string    $type       : 'info', 'primary', 'secondary', 'warning', 'danger', 'success', 'light'
     * @param ?bool      $dismiss    : if set to false, the alert cannot be dismissed.
     * @param ?int       $zIndex     : overlapping elements with a larger z-index cover those with a smaller one.
     * @param ?string    $textColor  : Bootstrap color classes: 'primary' for 'text-primary', 'secondary' for 'text-secondary' etc.
     *
     * @return string                : Bootstrap Alert component (HTML)
     */
    public function build(?string $msg = '', ?string $type = 'info', ?bool $dismiss = true, ?int $zIndex = null, ?string $textColor = ''): string
    {
        $buttonHtml = <<<HEREDOC
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
HEREDOC;

        $dismissible = ($dismiss === true) ? "alert-dismissible" : '';
        $button = ($dismiss === true) ? $buttonHtml : '';
        $z = ($zIndex !== null) ? "style='z-index: $zIndex;'" : '';
        $textColor = ($textColor !== '') ? 'text-' . $textColor : '';

        $alertHtml = <<<HEREDOC
  <div class="alert $textColor alert-$type $dismissible fade show" role="alert" $z>
  $msg
  $button
  </div>
HEREDOC;

        $this->html = $alertHtml; // store component HTML

        return $alertHtml; // return component HTML
    }
}