<?php namespace DataBase;
$_POST = json_decode(file_get_contents('php://input'), true);
require_once 'Conection.php';

require 'Students.php';
use DataBase\Students;
$students = new Students;


$connection= new Conection;
$conected = $connection->Connect();

// var_dump($user_id);

// esta funcion obtengo solo los alumnos que tienen actividads asignadas y las pinto en patalla dentro de un select
// $students->getStudents();



// var_dump($_POST);
// obtengo el id y hago la consulta para obtener todas las actividades de un estudiante en particular
// con esta funcion regreseo un json con la info y lo pinto en pantalla
if(isset($_POST['getInfo'])){

    // echo "ënotr getInfo";
    $user_id=(int)$_POST['getInfo'];
    $students->getInfoUserById($user_id); /* <-- aqui solo la obtengo lo pinto con JS */
}

if(isset($_POST['edit'])){

    $dataUser = $_POST;

    $students->updateUser($dataUser); /* <-- Edito */
   /* <-- aqui solo la obtengo lo pinto con JS */
}



if(isset($_POST['DeleteUser'])){
  $id = $_POST['id'];

  $students->deleleStudent($id);

}


















