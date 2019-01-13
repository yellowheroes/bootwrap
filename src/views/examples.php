<?php
/**
 * Created by Yellow Heroes
 * User: Robert
 * Date: 18/09/2018
 * Time: 15:35
 */

namespace yellowheroes\bootwrap;

use yellowheroes\bootwrap\config as config;
use yellowheroes\bootwrap\libs\Documentor;

/*
 * Easily render BootWrap components in your VIEW page
 *
 * We require views/header.php in all our VIEWs. This is
 * convenient as it gives access to two important objects
 * that enable quick rendering of BootWrap components in your VIEW:
 * 1. $bootWrap
 * 2. $body
 *
 * $bootWrap is an instance of class BootWrap: new libs\BootWrap())
 * $body is an instance of class Body: new libs\Body().
 *
 * function signature
 * Body::render(BootWrap $bootWrap, array $components): bool
 *
 * $body->render() needs two params:
 * 1. a type BootWrap variable (a BootWrap object)
 * 2. an array with (a) Bootwrap component(s).
 *
 * Usage: $body->render($bootWrap, $components)
 */
require dirname(__DIR__) . "/views/header.php";

/**
 * intro generator
 *
 * generate a short introduction explaining what the component
 * is about and use case(s)
 *
 * @param string $title     : name of Bootstrap component
 * @param string $des       : description of component (usage)
 * @param string $content   : notes
 *
 * @return string           : intro-html
 */
function intro(string $title = '', string $des = '', string $content = ''): string
{
    $introHtml = <<<HEREDOC
<div class = 'row' style="margin-top: 50px;">
    <h1 id="content">$title</h1>
</div>
<div class = 'row' style="margin-bottom: 10px;">
    <p>$des</p>
</div>
<div class = 'row' style="margin-bottom: 10px;">
    <p>$content</p>
</div>
HEREDOC;
    return $introHtml;
}

/**
 * code snippet generator
 *
 * we use 'NOWDOC' so we can just copy-paste the code and
 * send it as param $code to function usage().
 *
 * we use Highlight.js for code highlighting (change theme in Config.php)
 * code highlighting is triggered by <pre><code></code></pre> block
 *
 * @param string $code  : php code snippet (example)
 *
 * @return string       : code snippet html
 */
function usage(string $code = ''): string
{
    $codeHtml = "<pre><code>" . $code . "</code></pre>";
    return $codeHtml;
}

/*
 * start view-page examples.php content
 */

/*
 * example: alert
 */
$title = "Alert";
$des = "Provide contextual feedback messages for typical user actions with the handful of available and flexible alert messages.";
$content = "Some more information";
echo intro($title, $des, $content);
/* render code snippet -1- */
$msg = 'I am an alert box, and I\'m here to stay';
$components = ['alert' => [$msg, 'info', false]];
$code = <<<'NOWDOC'
$msg = "I am an alert box, and I'm here to stay";
$components = ['alert' => [$msg, 'info', false]];
$body->render($bootWrap, $components);
NOWDOC;
echo usage($code);
/* render component -1- */
$body->render($bootWrap, $components);

/* render code snippet -2- */
$msg = 'I am a dismissable alert box, give it a try...';
$components = ['alert' => [$msg, 'info', true]];
$code = <<<'NOWDOC'
$msg = 'I am a dismissable alert box';
$components = ['alert' => [$msg, 'info', true]];
$body->render($bootWrap, $components);
NOWDOC;
echo usage($code);
/* render component -2- */
$body->render($bootWrap, $components);

/*
 * example: card
 * signature: public function card($title = null, $msg = null, $class = 'primary',
 *                                  $list = [], $links = [], $blank = false,
 *                                  $image = null, $footer = null): string
 */
$title = "Card";
$des = "cards provide a flexible and extensible content container with multiple variants and options.";
$content = "A card is a flexible and extensible content container. It includes options for headers and footers,
a wide variety of content, contextual background colors, and powerful display options. If you’re familiar with
Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is
available as modifier classes for cards.";
echo intro($title, $des, $content);
/* render code snippet */
$msg = 'I am a card';
$title = 'BootWrap all the way';
$list = ['1' => 'list item 1', '2' => 'list item 2', '3' => 'list item 3'];
$links = ["examples.php" => 'BootWrap examples'];
$image = ["../images/yh_logo.png", 10]; // image size 30% of container
$footer = "let's stay in touch";
$components = ['card' => [$title, $msg, 'primary', $list, $links, false, $image, $footer]];
$code = <<<'NOWDOC'
$msg = 'I am a card';
$title = 'BootWrap all the way';
$list = ['1' => 'list item 1', '2' => 'list item 2', '3' => 'list item 3'];
$links = ['BootWrap examples' => "www.yellowheroes.com/examples"];
$image = ["path/to/images/yellowheroes.png", 10]; // image size 10% of container
$footer = "let's stay in touch";
$components = ['card' => [$title, $msg, 'primary', $list, $links, false, $image, $footer]];
NOWDOC;
echo usage($code);
/* render component */
$body->render($bootWrap, $components);

/*
 * end view-page examples.php content
 */

require dirname(__DIR__) . "/views/footer.php";