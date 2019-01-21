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
 * @param string $id        : the html element id (for in-page links)
 * @param string $title     : name of Bootstrap component
 * @param string $des       : description of component (usage)
 * @param string $content   : notes
 *
 * @return string           : intro-html
 */
function intro(string $id = '', string $title = '', string $des = '', string $content = ''): string
{
    $introHtml = <<<HEREDOC
<div class="anchor">
<div id="$id" class = 'row' style="margin-top: 50px;">
    <h1 id="content">$title</h1>
</div>
<div class = 'row' style="margin-bottom: 10px;">
    <p>$des</p>
</div>
<div class = 'row' style="margin-bottom: 10px;">
    <p>$content</p>
</div>
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
 * @param string $code      : php code snippet (example)
 * @param string $comment   : a comment explaining how the code works
 * @param string $example   : e.g. example #1
 *
 * @return string           : code snippet html
 */
function usage(string $code = '', string $comment = '', string $example = 'code example'): string
{
    echo divider(); // render a horizontal ruler
    $codeHtml = "<div>" . $example . "</div>\n";
    $codeHtml .= "<pre><code>" . $code . "</code></pre>\n";
    $comment = ($comment !== '') ? "<div style='margin-left: -15px; margin-bottom: 10px;'>" . $comment . "</div>\n" : '';
    $codeHtml .= $comment;
    return $codeHtml;
}

/**
 * render a horizontal ruler
 */
function divider()
{
    echo "<div style='margin-left: -15px;'>";
    echo "<hr>";
    echo "</div>";
}

/*
 * start view-page examples.php content
 */

/*
 * list with in-page links to components
 */
$links = <<<HEREDOC
<a href="#" id="scroll" style="display: none;"><span></span></a> <!-- empty scroll-to-top target -->
<a href="#alert">Alert</a>\n
<a href="#card">Card</a>\n
<a href="#confirmationdialog">Confirmation Dialog</a>\n
<a href="#covernavigation">Cover Navigation (underlined)</a>\n
HEREDOC;
echo $links;


/*
 * example: alert
 */
$id = "alert";
$title = "Alert";
$des = "Provide contextual feedback messages for typical user actions with the handful of available and flexible alert messages.";
$content = "Three examples to show how easy it is to generate an alert.
There are 7 types of alerts: 'info', 'primary', 'secondary', 'warning', 'danger', 'success', 'light'";
echo intro($id, $title, $des, $content);
/* render code snippet -1- */
$msg = "I am an info alert, and I'm here to stay";
$components = ['alert' => [$msg, 'info', false]]; // params: [string message, string type, bool dismissable]
$code = <<<'NOWDOC'
$msg = "I am an info alert, and I'm here to stay";
$components = ['alert' => [$msg, 'info', false]]; // params: [string message, string type, bool dismissable]
$body->render($bootWrap, $components);
NOWDOC;
$example = "code example #1: use 'false' to make a sticky alert";
echo usage($code, '', $example);
/* render component -1- */
$body->render($bootWrap, $components);

/* render code snippet -2- */
$msg = "I am a dismissable warning alert - click the X and I'm gone";
$components = ['alert' => [$msg, 'warning', true]]; // params: [string message, string type, bool dismissable]
$code = <<<'NOWDOC'
$msg = "I am a dismissable warning alert - click the X and I'm gone";
$components = ['alert' => [$msg, 'warning', true]]; // params: [string message, string type, bool dismissable]
$body->render($bootWrap, $components);
NOWDOC;
$example = "code example #2: use 'true' to enable dismiss button";
echo usage($code, '', $example);
/* render component -2- */
$body->render($bootWrap, $components);

/* render code snippet -3- */
$msg = "I am a dismissable success alert <hr/>
With a horizontal ruler as a divider and a longer text.
In fact we can give quite a bit of information with an alert
and <i>format</i> the text with <b>regular</b> markup.";
$components = ['alert' => [$msg, 'success', true]]; // params: [string message, string type, bool dismissable]
$code = <<<'NOWDOC'
$msg = "I am a dismissable alert - colored for success &lthr&gt
With a horizontal ruler as a divider and a longer text.
In fact we can give quite a bit of information with an alert
and &lti&gtformat&lt/i&gt the text with &ltb&gtregular&lt/b&gt markup."
$components = ['alert' => [$msg, 'success', true]]; // params: [string message, string type, bool dismissable]
$body->render($bootWrap, $components);
NOWDOC;
$example = "code example #3";
echo usage($code, '', $example);
/* render component -2- */
$body->render($bootWrap, $components);
divider();
/* ----------------------------------------------------------------------------------------------------------------- */

/*
 * example: card
 * signature: public function card($title = null, $msg = null, $class = 'primary',
 *                                  $list = [], $links = [], $blank = false,
 *                                  $image = null, $footer = null): string
 */
$id = "card";
$title = "Card";
$des = "cards provide a flexible and extensible content container with multiple variants and options.";
$content = "It includes options for headers and footers,
a wide variety of content, contextual background colors, and powerful display options. If you’re familiar with
Bootstrap 3, cards replace old panels, wells, and thumbnails. Similar functionality to those components is
available as modifier classes for cards.";
echo intro($id, $title, $des, $content);
/* render code snippet */
$msg = 'I am a card';
$title = 'BootWrap all the way';
$list = ['1' => 'list item 1', '2' => 'list item 2', '3' => 'list item 3'];
$links = ["examples.php" => 'BootWrap examples',
            'mailto: admin@yellowheroes.com' => '<i class="fa fa-envelope-o" aria-hidden="true"></i> send us an e-mail',
            'https://github.com/yellowheroes' => '<i class="fa fa-github" aria-hidden="true"></i> find us on GitHub'];
$image = ["../images/yh_logo.png", 10]; // image size 30% of container
$footer = "let's stay in touch";
$components = ['card' => [$title, $msg, 'primary', $list, $links, false, $image, $footer]]; // param 6(false): set to true to open links in new tab
$code = <<<'NOWDOC'
$msg = 'I am a card';
$title = 'BootWrap all the way';
$list = ['1' => 'list item 1', '2' => 'list item 2', '3' => 'list item 3'];
$links = ["examples.php" => 'BootWrap examples',
          'mailto: admin@yellowheroes.com' => '&lti class="fa fa-envelope-o" aria-hidden="true">&lt/i&gt send us an e-mail',
          'https://github.com/yellowheroes' => '&lti class="fa fa-github" aria-hidden="true">&lt/i&gt find us on GitHub'];
$image = ["path/to/images/yellowheroes.png", 10]; // image size 10% of container
$footer = "let's stay in touch";
$components = ['card' => [$title, $msg, 'primary', $list, $links, false, $image, $footer]]; // param 6(false): set to true to open links in new tab
NOWDOC;
$comment = "This card includes an image (at 10% of the container size), a title, a message,
a list with 3 items, a link and a footer. Parameter 6 (boolean false), means the links won't open
in a new window (_blank) - set it to true if you'd like to change this behavior.";
echo usage($code, $comment);
/* render component */
$body->render($bootWrap, $components);

/* ----------------------------------------------------------------------------------------------------------------- */

/*
 * example: confirmation dialog
 * signature: public function confirmationDialog($display = '', $id = 'confirmationDialog',
 *                                               $msg = 'Please confirm...', $href = true): string
 */
$id = "confirmationdialog";
$title = "Confirmation Dialog";
$des = "Confirmation dialogs are used for situations where a user must confirm an action.";
$content = "Use this component to confirm changes to e.g. file content, or file deletes etc.
The confirmation dialog form uses POST method to send the user's choice back to the server:
\$_POST['confirm'] and \$_POST['cancel']. Important, if you use multiple confirmation dialogs
on the same page, make sure you give each of the dialogs a unique ID (#id).";
echo intro($id, $title, $des, $content);
/* render code snippet -1- */
$display = 'Delete blog post';
$components = ['confirmationdialog' => [$display, 'confirmationDialog#1']];
$code = <<<'NOWDOC'
$display = 'Delete blog post';
$components = ['confirmationdialog' => [$display, 'confirmationDialog#1']];
NOWDOC;
$comment = "A hyperlink that triggers a confirmation dialog. The blog post will only be deleted if you confirm";
$example = "code example #1";
echo usage($code, $comment, $example);
/* render component -1- */
$body->render($bootWrap, $components);

/* render code snippet -2- */
$display = 'Delete blog post';
$components = ['confirmationdialog' => [$display, 'confirmationDialog#2', 'Please confirm', false]]; // false to use a button
$code = <<<'NOWDOC'
$display = 'Delete blog post';
$components = ['confirmationdialog' => [$display, 'confirmationDialog#2', 'Please confirm', false]]; // false to use a button
NOWDOC;
$comment = "A button that triggers a confirmation dialog. The blog post will only be deleted if you confirm";
$example = "code example #2";
echo usage($code, $comment, $example);
/* render component -2- */
$body->render($bootWrap, $components);

/* ----------------------------------------------------------------------------------------------------------------- */

/*
 * example: cover navigation
 * signature: public function coverNav($navItems = [], $activeNav = '', $brand = null): string
 */
$id = "covernavigation";
$title = "Cover navigation";
$des = "A navigation bar with underlined active nav button. We came accross this style at: https://getbootstrap.com/docs/4.0/examples/cover/#.
For the styling to work, you MUST incorporate a css stylesheet defining the link-text coloring and the color of the bar under the active button.";
$content = "...";
echo intro($id, $title, $des, $content);
/* render code snippet -1- */
$navItems = ['home' => '#', 'examples' => 'examples.php', 'contact' => '#', 'documentation' => '#'];
$components = ['covernav' => [$navItems, 'examples.php', '']];
$code = <<<'NOWDOC'
$navItems = ['home' => '#', 'examples' => 'examples.php', 'contact' => '#', 'documentation' => '#'];
$components = ['covernav' => [$navItems, '', '']];
NOWDOC;
$comment = "no comment";
$example = "code example #1";
echo usage($code, $comment, $example);
/* render component -1- */
$body->render($bootWrap, $components);

/*
 * end view-page examples.php content
 */

require dirname(__DIR__) . "/views/footer.php";