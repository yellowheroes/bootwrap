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

//require dirname(__DIR__, 2) . "/vendor/autoload.php";
require dirname(__DIR__) . "/views/header.php";

/*
 * start view-page documentation.php content
 */

//object $bootWrap is created in header.php, so we can use it here
$reflector = new \ReflectionClass($bootWrap);
// store all class methods in array
$classMethods = get_class_methods($bootWrap);
asort($classMethods);

echo "Class BootWrap";
echo '<br />';
// render the Class-level DocBlock
$msg = $reflector->getDocComment();
echo $bootWrap->alert()
echo '<br /><br />';

echo "Class BootWrap methods:";
foreach ($classMethods as $methodName) {
    echo "<a href =''>" . $methodName . "</a>" . "<br />";
    // render method DocBlock
    echo '<pre>';
    echo $reflector->getMethod($methodName)->getDocComment();
    echo '</pre>';
}


/*
 * end view-page documentation.php content
 */

require dirname(__DIR__) . "/views/footer.php";