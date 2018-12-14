<?php
/**
 * Created by Yellow Heroes
 * Project: bootwrap
 * File: index.php
 * User: Robert
 * Date: 14/12/2018
 * Time: 10:21
 */
/* redirect user to view-page 'views/index.php' */
$index = './views/index.php';
header('Location: ' . $index);
exit();