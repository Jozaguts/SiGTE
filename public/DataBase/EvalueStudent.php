<?php namespace DataBase;
require_once 'Conection.php';

require 'Students.php';
use DataBase\Students;
$students = new Students;

$connection= new Conection;
$conected = $connection->Connect();
$_POST = json_decode(file_get_contents('php://input'), true);
$user_id=(int)$_POST;
// var_dump($user_id);
// esta funcion obtengo solo los alumnos que tienen actividads asignadas y las pinto en patalla dentro de un select
$students->getStudentsWithAssignedActivities();

// obtengo el id y hago la consulta para obtener todas las actividades de un estudiante en particular
// con esta funcion regreseo un json con la info y lo pinto en pantalla

echo $students->getAllTheActivitiesOfAStudent($user_id); /* <-- aqui solo la obtengo lo pinto con JS */













