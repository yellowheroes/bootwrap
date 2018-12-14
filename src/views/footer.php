<?php
/**
 * Created by Yellow Heroes
 * User: Robert
 * Date: 18/09/2018
 * Time: 15:35
 */
namespace yellowheroes\bootwrap;

use yellowheroes\bootwrap\config as config;

//require dirname(__DIR__, 1) . "/vendor/autoload.php";

$config = new config\Config();
$bootWrap = new libs\BootWrap();

/*
 * <footer> </footer> block
 */
$hrefs = [
    // title            display         href        display         href
    'general' => ['contact us' => 'contact.php', 'about us' => 'about.php'],
    'products' => ['bits and pieces' => 'prod1.php', 'scrap and metal' => 'prod2.php'],
    'other' => ['sitemap' => 'sitemap.php', 'license' => 'license.php']
];

$copyright = 'Jimbean';
$components = [$copyright, $hrefs];
$invoke = new libs\Footer($bootWrap, $components);