<?php
/**
 * Created by Yellow Heroes
 * Project: bootwrap
 * File: home.php
 * User: Robert
 * Date: 14/12/2018
 * Time: 10:21
 */
/* redirect user to view-page 'views/home.php' */
$index = './views/home.php';
header('Location: ' . $index);
exit();