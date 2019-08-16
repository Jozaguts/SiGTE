<?php
$_POST = json_decode(file_get_contents('php://input'), true);

require_once 'Activities.php';

use DataBase\Activities;


$activity = new Activities;



if(isset($_POST['assignActivity'])){

    $id_activity = $_POST['id_activity'];
    $id_student = $_POST['id_student'];
    $activity->assignActivity($id_student,$id_activity);

}

if(isset($_POST['getInfoActivity'])){

    $id_activity = $_POST['id'];
    $activity->getInfoActivityByIdActivity($id_activity);

}


if(isset($_POST['validateActivity'])){

    $id_activity = $_POST['id'];
    $value = $_POST['value'];

    $activity->validateActivity($id_activity,$value);

}




