<?php
/**
 * Created by Yellow Heroes
 * User: Robert
 * Date: 18/09/2018
 * Time: 15:35
 */
namespace yellowheroes\bootwrap;

use yellowheroes\bootwrap\config as config;

require dirname(__DIR__) . "/views/header.php";

/*
 * start view-page contact.php content
 */

/* card with contact details */
$links = ['mailto: admin@yellowheroes.com' => '<i class="fa fa-envelope-o" aria-hidden="true"></i> send us an e-mail',
    'https://github.com/yellowheroes' => '<i class="fa fa-github" aria-hidden="true"></i> find us on GitHub'
];
$footer = "We won't promise to come back to you, but we'll try...";
$contactCard = $bootWrap->card('Yellow Heroes', 'Want to get in touch?', 'light', null, $links, true, null, $footer); // set blank=true to open links in new tab
echo $contactCard;
/*
 * end view-page contact.php content
 */

require dirname(__DIR__) . "/views/footer.php";