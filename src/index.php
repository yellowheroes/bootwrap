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

$invoke = new Header($bootWrap);

/* construct array of component(s) for rendering in body */
$components = ['jumbotron' => array('yoohoo', 'there it is', 'enjoy BootWrap')];
$invoke = new Body($bootWrap, $components);

$invoke = new Footer($bootWrap);
