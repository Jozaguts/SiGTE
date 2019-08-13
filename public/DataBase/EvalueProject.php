<?php
require_once 'Conection.php';
require_once 'Activities.php';
$_POST = json_decode(file_get_contents('php://input'), true);

use DataBase\Activities;

$activities = new Activities;

$activities->getActivitiesByProject((int)$_POST);



