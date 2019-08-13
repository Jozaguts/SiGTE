<?php
require "Activities.php"; 

use DataBase\Activities;
$_POST = json_decode(file_get_contents('php://input'), true);


$id = $_POST;

(int)$id;

$Activities = new Activities;

$Activities->getActivitiesByProject($id);