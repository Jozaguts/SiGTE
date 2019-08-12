<?php
$_POST = json_decode(file_get_contents('php://input'), true);

require 'Students.php';
use DataBase\Students;
$students = new Students;

$res = $students->SetScoreStudent($_POST);




