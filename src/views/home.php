<?php
/**
 * Created by Yellow Heroes
 * User: Robert
 * Date: 18/09/2018
 * Time: 15:35
 */
namespace yellowheroes\bootwrap;

use yellowheroes\bootwrap\config as config;

//require dirname(__DIR__, 2) . "/vendor/autoload.php";
require dirname(__DIR__) . "/views/header.php";

/*
 * start view-page home.php content
 */

/* jumbotron welcome */
$msg = "BootWrap is a modest PHP 'wrapper' that aims to make using Bootstrap components
        in your web project easy and fun.";
echo $bootWrap->jumbotron('BootWrap', $msg);

$code = "<?php echo 'hello'; ?>";

echo "<pre>";
highlight_string($code);
echo "</pre>";

/*
 * end view-page home.php content
 */

require dirname(__DIR__) . "/views/footer.php";