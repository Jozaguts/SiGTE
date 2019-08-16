<?php $_POST = json_decode(file_get_contents('php://input'), true);
require_once 'Activities.php';


use DataBase\Activities;


if(isset($_FILES["evidence"]["type"]))
{

   
    $urll="../uploads/";
    $sourcePath = $_FILES['evidence']['tmp_name'];
    $nombreArchivo = $_FILES['evidence']['name'];

    if(move_uploaded_file($sourcePath,$urll.$nombreArchivo)) {
        echo "/public/uploads/".$nombreArchivo;
        } else {
        var_dump($sourcePath,$urll.$nombreArchivo);
        }


     

}

if(isset($_POST['operacion']) == "uploadEvidence"){

$activity = new Activities;
$id_actividad = $_POST['id_activity'];
$route = $_POST['route_activity_file'];


    $activity->updateEvidence($id_actividad, $route);


}


?>