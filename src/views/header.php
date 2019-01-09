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
$body = new libs\Body(); // use this object in your VIEW(s) to render BootWrap component(s)

/*
 * <head> </head> block
 * Bootswatch themes (21): cerulean, cosmo, cyborg, darkly, flatly, journal, litera, lumen, lux, materia, minty,
 * pulse, sandstone, simplex, sketchy, slate, solar, spacelab, superhero, united, yeti
 */
$components = ['tabtitle' => $config::TABTITLE, 'theme' => $config::BOOTSWATCH_THEME];
$invoke = new libs\Header($bootWrap, $components);

/*
 * VIEW header.php contains the navigation menu (navbar) to ensure it is
 * automatically rendered on all pages.
 *
 * The navbar sits in the <header> </header> block.
 */
// $activeNav colors the selected view-page nav-button
$activeNav = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);

$home = "home.php";
$examples = "examples.php";
$contact = "contact.php";
$documentation = "documentation.php";

$navItems = ['home' => $home, 'examples' => $examples, 'contact' => $contact, 'documentation' => $documentation];

$logo = ['BootWrap', '../images/yh_logo.png', ''];
$components = ['navbar' => [$navItems, $activeNav, null, 'primary', 'sm', 'dark', 'dark', 'top', $logo]];

/* instantiate a Body object */
$body->render($bootWrap, $components);