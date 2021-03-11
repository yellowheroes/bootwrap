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

/**
 * Class Custom
 * Custom is not a Bootstrap component, it can be used for
 * injecting client-provided HTML into a Bootstrap starter template.
 *
 * @package yellowheroes\bootwrap\libs
 */
class Custom implements ComponentInterface
{
    public string $html = ''; // container to store client-provided HTML

    /**
     * @param string $html    : HTML to be injected inside the <body> </body> tags
     *
     * @return string         : client-provided HTML
     */
    public function build(string $html = ''): string
    {
        /*
         * $html can be a user provided HTML snippet
         * or a reference to a file with a HTML snippet
         */
        if(is_file($html)) {
            $html = file_get_contents($html);
        }

        $customHtml = <<<HEREDOC
  $html\n
HEREDOC;

        $this->html = $customHtml;

        return $customHtml;
    }
}