<?php
/**
 * Created by Yellow Heroes
 * Project: bootwrap
 * File: index.php
 * User: Robert
 * Date: 14/12/2018
 * Time: 10:21
 */
$index = './views/index.php';
echo $index;
header('Location: ' . $index);
exit();