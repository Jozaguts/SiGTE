<?php namespace DataBase;
require_once 'Conection.php';

require 'Students.php';
use DataBase\Students;
$students = new Students;

$connection= new Conection;
$conected = $connection->Connect();
$_POST = json_decode(file_get_contents('php://input'), true);


$user_id=(int)$_POST;



$res = $students->getStudentsWithAssignedActivities($user_id);



