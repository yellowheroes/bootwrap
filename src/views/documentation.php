<?php
/**
 * Created by Yellow Heroes
 * User: Robert
 * Date: 18/09/2018
 * Time: 15:35
 */

namespace yellowheroes\bootwrap;

use yellowheroes\bootwrap\config as config;
use yellowheroes\bootwrap\libs as libs;

/*
 * Easily render BootWrap components in your VIEW page
 *
 * We require views/header.php in all our VIEWs. This is
 * convenient as it gives access to two important objects
 * that enable quick rendering of BootWrap components.
 *
 * Specifically: views/header.php creates objects: $bootWrap and $body.
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

/*
 * start view-page documentation.php content
 */
$doc = new libs\Documentor($bootWrap);
$docBlocks = $doc->getDoc();

/*
echo '<pre>';
var_dump($docBlocks);
echo '</pre>';
*/

foreach($docBlocks as $key => $docBlock) {
    $component = ['alert' => [$docBlock, 'info', false, false]];
    $body->render($bootWrap, $component);
}
/*
 * end view-page documentation.php content
 */
require dirname(__DIR__) . "/views/footer.php";