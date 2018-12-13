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

/*
 * <head> </head> block
 * Bootswatch themes (21): cerulean, cosmo, cyborg, darkly, flatly, journal, litera, lumen, lux, materia, minty,
 * pulse, sandstone, simplex, sketchy, slate, solar, spacelab, superhero, united, yeti
 */
$components = ['tabtitle' => 'BootWrap', 'theme' => 'spacelab'];
$invoke = new Head($bootWrap, $components);

/*
 * <body> </body> block
 * construct array with component(s) for rendering in body
 */
$activeNav = basename($_SERVER["SCRIPT_FILENAME"], '.php');

$index = "index.php";
$blog = "blog.php";
$quill = "quill.php";
$chat = "chat.php";
$contact = "contact.php";
$register = "register.php";
$deregister = "deregister.php";
$logout = "logout.php";

$navItems = ['home' => $index, 'blog' => $blog, 'quill' => $quill, 'chat' => $chat, 'contact' => $contact,
    'admin' => ['register new user' => $register,
        'remove existing user' => $deregister, 'hr1' => '',
        'logout' => $logout]];

//$type = null, $class = 'primary', $size = 'md', $textColor = 'dark', $bgColor = 'dark', $alignment = 'top',
//$logo = [], $userName = 'visitor', $toolTip = null, $location = null, $search = false
$logo = ['BootWrap', './images/yh_logo.png', ''];
$components = ['navbar' => [$navItems, $activeNav, null, 'primary', 'sm', 'dark', 'dark', 'top', $logo]];
$invoke = new Body($bootWrap, $components);

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
$invoke = new Footer($bootWrap, $components);
