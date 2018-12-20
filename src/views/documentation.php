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

require dirname(__DIR__) . "/views/header.php";

/*
 * start view-page documentation.php content
 */

$bootWrap = new libs\BootWrap();
$reflector = new \ReflectionClass($bootWrap);
$classMethods = get_class_methods($bootWrap); // store all class methods in array
asort($classMethods); // sort class methods alphabetically
$classMethods = array_values($classMethods);

echo $bootWrap->alert('info', "Class BootWrap", false, false);
echo '<br />';

/* new */
$classDocComment = $reflector->getDocComment(); // the Class-level DocBlock
$store[] = explode(PHP_EOL, $classDocComment);

$storeTemp = [];
foreach ($classMethods as $method) {
    $methodDocCom = $reflector->getMethod($method)->getDocComment();
    $storeTemp[] = explode(PHP_EOL, $methodDocCom);
}

foreach ($storeTemp as $key0 => $value0) {
    foreach ($value0 as $key1 => $value1) {
        $store[$key0+1][] = ltrim($value1);
    }
}

echo '<pre>';
var_dump($store);
echo '</pre>';


foreach ($classMethods as $key => $method) {
    $methodName = "<a href =''>" . $method . "</a>" . "<br /><br />";
    //$methodDocComment = '<pre style="font-weight: 400 !important; font-size: 0.8em;">';
    foreach($store as $key => $value) {
        $methodDocComment = "<pre>";
        foreach($value as $key1 => $value1) {
            $methodDocComment .= $store[$value1];
        }
        $methodDocComment .= "</pre";
    }


    echo $bootWrap->alert('success', $methodName . $methodDocComment, false, false);
    // render method DocBlock
    //echo '<pre>';
    //echo $reflector->getMethod($methodName)->getDocComment();
    //echo '</pre>';
}


/* end new */


/*
$classDocComment = $reflector->getDocComment(); // the Class-level DocBlock
$msg = <<<HEREDOC
<pre>$classDocComment</pre>
HEREDOC;

echo $bootWrap->alert('info', $msg, false, false);
echo '<br /><br />';

echo "<div class='row' style='margin: 20px !important;'>";
echo "<div class='col'>";
echo "Class BootWrap methods:" . '<br /><br />';
echo "</div>";
echo "</div>";


foreach ($classMethods as $method) {
    echo "<div class='row'>";
    $methodName = "<div class='row'><a href =''>" . $method . "</a></div>" . "<br /><br />";
    $methodDocComment = '<div class=\'row\'><pre class="pull-left text-left" style="font-weight: 400 !important; font-size: 0.8em;">' .
                        $reflector->getMethod($method)->getDocComment() .
                        '</pre></div>';
    echo "<div class='col'>";
    echo $bootWrap->alert('success', $methodName . $methodDocComment, false, false);
    echo "</div>"; // end column
    echo "</div>"; // end row
    // render method DocBlock
    //echo '<pre>';
    //echo $reflector->getMethod($methodName)->getDocComment();
    //echo '</pre>';
}
*/

/*
 * end view-page documentation.php content
 */

require dirname(__DIR__) . "/views/footer.php";