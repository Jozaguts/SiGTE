<?php
$_POST = json_decode(file_get_contents('php://input'), true);

require 'Students.php';
use DataBase\Students;
$students = new Students;

$res = $students->assingStudent($_POST);

echo $res;


// ESTA ES LA RESPUSTA JSON NO BORRAR
// echo json_encode($_POST);
