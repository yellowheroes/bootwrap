<?php
/**
 * Created by Yellow Heroes
 * User: Robert
 * Date: 18/09/2018
 * Time: 15:35
 */
namespace yellowheroes\bootwrap;

use yellowheroes\bootwrap\libs as libs;
use yellowheroes\bootwrap\config as config;

require dirname(__DIR__, 2) . "/vendor/autoload.php";

$config = new config\Config();
$bootWrap = new libs\BootWrap();

/*
 * <head> </head> block
 * Bootswatch themes (21): cerulean, cosmo, cyborg, darkly, flatly, journal, litera, lumen, lux, materia, minty,
 * pulse, sandstone, simplex, sketchy, slate, solar, spacelab, superhero, united, yeti
 */
$components = ['tabtitle' => $config::TABTITLE, 'theme' => $config::BOOTSWATCH_THEME];
$invoke = new libs\Head($bootWrap, $components);

/*
 * <body> </body> block
 * construct array with component(s) to be rendered in body
 */
// $activeNav colors the selected view-page nav-button
$activeNav = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
// adjust $activeNav where button display-name !== script linked
if($activeNav === 'index') {
    $activeNav = 'home';
}

$index = "index.php";
$examples = "examples.php";
$contact = "contact.php";

$navItems = ['home' => $index, 'examples' => $examples, 'contact' => $contact];

$logo = ['BootWrap', '../images/yh_logo.png', ''];
$components = ['navbar' => [$navItems, $activeNav, null, 'primary', 'sm', 'dark', 'dark', 'top', $logo]];
$invoke = new libs\Body($bootWrap, $components);