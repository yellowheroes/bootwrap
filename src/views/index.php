<?php
/**
 * Created by Yellow Heroes
 * User: Robert
 * Date: 18/09/2018
 * Time: 15:35
 */
namespace yellowheroes\bootwrap;

use yellowheroes\bootwrap\config as config;

echo 'yep';

require dirname(__DIR__, 2) . "/vendor/autoload.php";
require dirname(__DIR__) . "/views/header.php";

/*
 * start view-page index.php content
 */

/*
 * end view-page index.php content
 */

require dirname(__DIR__) . "/views/footer.php";