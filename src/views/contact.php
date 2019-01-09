<?php
/**
 * Created by Yellow Heroes
 * User: Robert
 * Date: 18/09/2018
 * Time: 15:35
 */
namespace yellowheroes\bootwrap;

use yellowheroes\bootwrap\config as config;

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
 * start view-page contact.php content
 */

/* construct a card with contact details: links and message */
$links = ['mailto: admin@yellowheroes.com' => '<i class="fa fa-envelope-o" aria-hidden="true"></i> send us an e-mail',
        'https://github.com/yellowheroes' => '<i class="fa fa-github" aria-hidden="true"></i> find us on GitHub'
];
$footer = "We won't promise to come back to you, but we'll try...";
$components = ['card' => ['Yellow Heroes', 'Want to get in touch?', 'light', null, $links, true, null, $footer]];
/* render the card */
$body->render($bootWrap, $components);

/*
 * end view-page contact.php content
 */
require dirname(__DIR__) . "/views/footer.php";