<?php
$_POST = json_decode(file_get_contents('php://input'), true);

require_once 'Activities.php';


use DataBase\Activities;
$activity = new Activities;
$id=$_POST;
(int)$id;
// obtengo projecto que tengan actividades

$activity->getActivitiesByProject($id);