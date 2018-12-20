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
$doc = new libs\Documentor($bootWrap);
$docBlocks = $doc->getDoc();

foreach($docBlocks as $key => $docBlock) {
    echo $bootWrap->alert('info', $docBlock, false, false);
}
/*
 * end view-page documentation.php content
 */

require dirname(__DIR__) . "/views/footer.php";