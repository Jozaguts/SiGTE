<?php
$_POST = json_decode(file_get_contents('php://input'), true);

require_once 'Activities.php';


use DataBase\Activities;
$activity = new Activities;
// $id=$_POST['id'];
$id_project = $_POST['id_project'];
(int)$id_project;
$id_activity = $_POST['id_activity'];
(int)$id_activity;

$activity->getinfoActivity($id_activity,$id_project);