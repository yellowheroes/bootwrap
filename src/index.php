<?php
/**
 * Created by Yellow Heroes
 * User: Robert
 * Date: 18/09/2018
 * Time: 15:35
 */
namespace yellowheroes\bootwrap;

require dirname(__DIR__, 1) . "/vendor/autoload.php";

$bootWrap = new BootWrap();

/* <head> </head> block */
$components = ['tabtitle' => 'BootWrappertje', 'theme' => 'superhero'];
$invoke = new Head($bootWrap, $components);

/*
 * <body> </body> block
 * construct array with component(s) for rendering in body
 */
$components = ['jumbotron' => array('BootWrap', 'Bootstrap components made easy', 'enjoy the ride')];
$invoke = new Body($bootWrap, $components);

/*
 * <footer> </footer> block
 */
/*
$hrefs = [
    // title            display         href        display         href
    'general' => ['contact us' => 'index.php', 'about us' => 'about.php'],
    'products' => ['bits and pieces' => 'prod1.php', 'scrap and metal' => 'prod2.php'],
    'other' => ['sitemap' => 'other.php', 'licence' => 'other2.php']
    ];
*/
$copyright = 'Jimbean';
$components = [$copyright];
$invoke = new Footer($bootWrap, $components);
