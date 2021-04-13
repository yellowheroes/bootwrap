<?php
/**
 * Created by Yellow Heroes
 * Project: bootwrap
 * File: index.php
 * User: Robert
 * Date: 8/23/2020
 * Time: 0:15
 */
namespace yellowheroes\bootwrap;

use yellowheroes\bootwrap\libs as libs;
use yellowheroes\bootwrap\libs\components as component;

require '../vendor/autoload.php';

/*
 * 1. build a Bootstrap template page
 */
$bw = new libs\BootWrap(); // build default starter template

/*
 * 2. build components & custom(non-component) user-provided HTML
 */
// build a jumbotron component
$jumbotron = new component\Jumbotron(); // create a jumbotron object
$jumbotron->setBgColor('info'); // set color
$jumbotron->setTxtColor('white'); // set color
$jumbotron->build('Bootwrap snazzy', 'all the way...',
                  'welcome to...');

// build some of your own custom HTML - manual and from file
$myHtml1 = new component\Custom(); // create a custom HTML object
$myHtml1->build("<p style='font-size: 20px;'>My paragraph</p>"); // manually build some HTML
$myHtml2 = new component\Custom(); // create a custom HTML object
$myHtml2->build("./assets/html/mysnippet.html"); // build HTML from file

// build an alert component
$alert = new component\Alert(); // create an alert object
$msg = '<h1>Your upload was successful</h1><hr><p>to manage your files, go to file manager</p>';
$alert->build($msg);

/*
 * 3. inject components and custom HTML into Bootstrap template page
 * BootWrap::inject() - injected content is stored in our BootWrap object($bw).
 */
$bw->inject($jumbotron); // inject component into Bootstrap template page
$bw->inject($myHtml1); // inject some custom user-provided Html
$bw->inject($myHtml2); // inject some custom user-provided Html
$bw->inject($alert); // inject component into Bootstrap template page

/*
 * 4. render Bootstrap template page with components and user supplied custom HTML
 * The injected HTML is rendered on a FIFO basis using BootWrap::render()
 */
echo $bw->render();

