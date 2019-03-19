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
 * codeSnippet: $body->render($bootWrap, $components)
 */
require dirname(__DIR__) . "/views/header.php";

/* ----------------------------------------------- START Helper functions ------------------------------------ */

/**
 * intro generator
 *
 * generate a short introduction explaining what the component
 * is about and use case(s)
 *
 * @param string $id        : the html element id (for in-page links)
 * @param string $title     : name of Bootstrap component
 * @param string $shortDes       : description of component
 * @param string $longDes   : notes
 *
 * @return string           : intro-html
 */
function intro(string $id = '', string $title = '', string $shortDes = '', string $longDes = ''): string
{
    $introHtml = <<<HEREDOC
<div class="row" style="margin-top: 50px; margin-left: -15px;">
<div id="$id" class="col anchor" style="margin-left: -15px;">
    <h1>$title</h1>
</div>
</div>

<div class = 'row' style="margin-bottom: 10px; margin-left: -15px;">
    <div class="col" style="margin-left: -15px;">$shortDes</div>
</div>

<div class = 'row' style="margin-bottom: 10px; margin-left: -15px;">
    <div class="col" style="margin-left: -15px;">$longDes</div>
</div>

HEREDOC;
    return $introHtml;
}

/**
 * codeSnippet() is a code codeSnippet generator
 *
 * we use 'NOWDOC' so we can just copy-paste the code and
 * send it as param $code to function codeSnippet().
 *
 * we use Highlight.js for code highlighting (change theme in Config.php)
 * code highlighting is triggered by <pre><code></code></pre> block
 *
 * @param string $code      : php code codeSnippet (example)
 * @param string $comment   : a comment explaining how the code works
 * @param string $example   : e.g. example #1
 *
 * @return string           : code codeSnippet html
 */
function codeSnippet(string $code = '', string $comment = '', string $example = 'code example'): string
{
    $rowColOpen = "<div class='row' style='margin-left: -15px; margin-bottom: 10px;><div class='col'>";
    $rowColClose = "</div></div>";

    echo ruler(); // render a horizontal ruler
    $codeHtml = '';
    /* example name */
    $codeHtml .= $rowColOpen;
    $codeHtml .= $example;
    $codeHtml .= $rowColClose;

    /* example code codeSnippet */
    $codeHtml .= $rowColOpen;
    $codeHtml .= "<pre><code>" . $code . "</code></pre>";
    $codeHtml .= $rowColClose;

    /* example comment */
    $comment = ($comment !== '') ? $comment : '';
    $codeHtml .= $rowColOpen;
    $codeHtml .= $comment;
    $codeHtml .= $rowColClose;

    $codeHtml .= $rowColOpen . $rowColClose; // empty space

    return $codeHtml;
}

/**
 * render a horizontal ruler
 */
function ruler()
{
    $ruler = "<div style='margin-left: -15px; margin-bottom: 30px; background-color: #0AF;'>" . "<hr />" . "</div>";
    return $ruler;
}

/* white space between component examples */
function divider()
{
    $rowColOpen = "<div class='row' style='margin-left: -15px; margin-bottom: 20px;><div class='col'>";
    $rowColClose = "</div></div>";
    $divider = $rowColOpen . ruler() . $rowColClose;
    return $divider;
}

/* ------------------------------------------------ END Helper functions ------------------------------------- */

/*
 * start view-page examples.php content
 */

/*
 * list with in-page links to examples (components)
 */
$links = <<<HEREDOC
<div class="row">
<div class="col">
<a href="#" id="scroll" style="display: none;"><span></span></a> <!-- empty scroll-to-top target -->
<a href="#alert">Alert</a> | 
<a href="#card">Card</a> | 
<a href="#confirmationdialog">Confirmation Dialog</a> | 
<a href="#covernavigation">Cover Navigation (underlined)</a> | 
<a href="#covernavigation">Form</a> |
</div>
</div>
HEREDOC;
echo $links;

echo "<a href='http://www.google.com'>google</a>";

/*
 * example: alert
 */
$id = "alert";
$title = "Alert";
$shortDes = "Provide contextual feedback messages for typical user actions with the handful of available and flexible alert messages.";
$longDes = "Three examples to show how easy it is to generate an alert.
There are 7 types of alerts: 'info', 'primary', 'secondary', 'warning', 'danger', 'success', 'light'";
echo intro($id, $title, $shortDes, $longDes);
/* render code codeSnippet -1- */
$msg = "I am an info alert, and I'm here to stay";
$components = ['alert' => [$msg, 'info', false]]; // params: [string message, string type, bool dismissable]
$code = <<<'NOWDOC'
$msg = "I am an info alert, and I'm here to stay";
$components = ['alert' => [$msg, 'info', false]]; // params: [string message, string type, bool dismissable]
$body->render($bootWrap, $components);
NOWDOC;
$example = "code example #1: use 'false' to make a sticky alert";
echo codeSnippet($code, '', $example);
/* render component -1- */
$body->render($bootWrap, $components);

/* render code codeSnippet -2- */
$msg = "I am a dismissable warning alert - click the X and I'm gone";
$components = ['alert' => [$msg, 'warning', true]]; // params: [string message, string type, bool dismissable]
$code = <<<'NOWDOC'
$msg = "I am a dismissable warning alert - click the X and I'm gone";
$components = ['alert' => [$msg, 'warning', true]]; // params: [string message, string type, bool dismissable]
$body->render($bootWrap, $components);
NOWDOC;
$example = "code example #2: use 'true' to enable dismiss button";
echo codeSnippet($code, '', $example);
/* render component -2- */
$body->render($bootWrap, $components);

/* render code codeSnippet -3- */
$msg = "I am a dismissable success alert <hr/>
With a horizontal ruler as a divider and a longer text.
In fact we can give quite a bit of information with an alert
and <i>format</i> the text with <b>regular</b> markup.";
$components = ['alert' => [$msg, 'success', true]]; // params: [string message, string type, bool dismissable]
$code = <<<'NOWDOC'
$msg = "I am a dismissable success alert &lthr/&gt
With a horizontal ruler as a divider and a longer text.
In fact we can give quite a bit of information with an alert
and &lti&gtformat&lt/i&gt the text with &ltb&gtregular&lt/b&gt markup."
$components = ['alert' => [$msg, 'success', true]]; // params: [string message, string type, bool dismissable]
$body->render($bootWrap, $components);
NOWDOC;
$example = "code example #3";
echo codeSnippet($code, '', $example);
/* render component -2- */
$body->render($bootWrap, $components);
echo divider();
/* ----------------------------------------------------------------------------------------------------------------- */

/*
 * example: card
 * signature: public function card($title = null, $msg = null, $class = 'primary',
 *                                  $list = [], $links = [], $blank = false,
 *                                  $image = null, $footer = null): string
 */
$id = "card";
$title = "Card";
$shortDes = "cards provide a flexible and extensible content container with multiple variants and options.";
$longDes = "It includes options for headers and footers,
a wide variety of content, contextual background colors, and powerful display options. If you’re familiar with
Bootstrap 3, cards replace old panels, wells, and thumbnails. Similar functionality to those components is
available as modifier classes for cards.";
echo intro($id, $title, $shortDes, $longDes);
/* render code codeSnippet */
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
echo codeSnippet($code, $comment);
/* render component */
$body->render($bootWrap, $components);
echo divider();
/* ----------------------------------------------------------------------------------------------------------------- */

/*
 * example: confirmation dialog
 * signature: public function confirmationDialog($display = '', $id = 'confirmationDialog',
 *                                               $msg = 'Please confirm...', $href = true): string
 */
$id = "confirmationdialog";
$title = "Confirmation Dialog";
$shortDes = "Confirmation dialogs are used for situations where a user must confirm an action.";
$longDes = "Use this component to confirm changes to e.g. file content, or file deletes etc.
The confirmation dialog form uses POST method to send the user's choice back to the server:
\$_POST['confirm'] and \$_POST['cancel']. Important, if you use multiple confirmation dialogs
on the same page, make sure you give each of the dialogs a unique ID (#id) and a unique 'name' field.";
echo intro($id, $title, $shortDes, $longDes);
/* render code codeSnippet -1- */
$display = 'Delete blog post';
$components = ['confirmationdialog' => [$display, false, 'confirmationDialog1', 'confirm1', 'Please confirm', true]];
$code = <<<'NOWDOC'
$display = 'Delete blog post';
$components = ['confirmationdialog' => [$display, false, 'confirmationDialog1', 'confirm1', 'Please confirm', true]];
NOWDOC;
$comment = "This first example shows how we can use a hyperlink to trigger a confirmation dialog.
            The blog post will only be deleted if you confirm. <br /><br />
            Notice how we use a unique #id(confirmationDialog1) and name (confirm1) because we are showing
            two examples on this page - we do not want #id or 'name-field' conflicts. <br /><br />
            We DO NOT render an 'action=' attribute at all in this example - \$action is set to false.";
$example = "code example #1";
echo codeSnippet($code, $comment, $example);
/* render component -1- */
$body->render($bootWrap, $components);

/* render code codeSnippet -2- */
$display = 'Delete blog post';
$components = ['confirmationdialog' => [$display, false, 'confirmationDialog2', 'confirm2', 'Please confirm', false]]; // false to use a button
$code = <<<'NOWDOC'
$display = 'Delete blog post';
$components = ['confirmationdialog' => [$display, false, 'confirmationDialog2', 'confirm2', 'Please confirm', false]]; // false to use a button
NOWDOC;
$comment = "This second example shows how we can use a button that triggers a confirmation dialog.
            The blog post will only be deleted if you confirm. <br /><br />
            Notice how we use a unique #id(confirmationDialog2) and name (confirm2) because we are showing
            two examples on this page - we do not want #id or 'name-field' conflicts.<br /><br />
            We DO NOT render an 'action=' attribute at all in this example - \$action is set to false.";
$example = "code example #2";
echo codeSnippet($code, $comment, $example);
/* render component -2- */
$body->render($bootWrap, $components);
echo divider();
/* ----------------------------------------------------------------------------------------------------------------- */

/*
 * example: form
 * signature: public function form($inputFields = [], $submitDisplay = 'submit', $method = 'POST', $action = "#", $formId = "formId", $backHref = false, $backDisplay = 'Back', $confirmationDialog = [false, true, ''])
 *            $inputFields === ['type', 'name', 'id', 'value', 'placeholder', 'label', options[]]
 */
$id = "form";
$title = "Form";
$shortDes = "Generate a form with input element types like: text, password, email, or hidden. Surely, you can just as easily generate 
a select list or radio buttons that offer the user a pre-defined list of choices. <br /><br />
A cool new feature with BootWrap::form() is that it allows you to get a user to confirm an action (see example #3). <br /><br />
The default form submit method is 'POST' and the submit button has a \"name='submit'\".<br /><br />
You can thus check form submission with isset(\$_POST['submit'])";
$longDes = "";
echo intro($id, $title, $shortDes, $longDes);
/* render code codeSnippet -1- */
$inputFields = [
    ['text', 'username', 'username', "", 'enter user name', 'your username', ['required']],
    ['password', 'password', 'password', "", 'password', 'your password', ['required']]
];
$form = [$inputFields, 'Sign In'];
$components = ['form' => $form];
$code = <<<'NOWDOC'
$form = $bootWrap->form($inputFields, 'Sign In');
$components = ['form' => [$form]];
echo $form;

if (isset($_POST['submit'])) {
...
}
NOWDOC;
$comment = "no comment";
$example = "code example #1: Form";
echo codeSnippet($code, $comment, $example);

/* render component -1- */
$body->render($bootWrap, $components);

echo divider();


/*
 * end view-page examples.php content
 */

require dirname(__DIR__) . "/views/footer.php";