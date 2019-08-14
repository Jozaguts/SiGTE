<?php namespace DataBase;
$_POST = json_decode(file_get_contents('php://input'), true);
require "Activities.php";
require "Projects.php";

use DataBase\Activities;
use DataBase\Projects;



// $action = $_POST['request'];

// $data=$_POST['data'];


if(isset($_POST['request'])){

    $activity = new Activities;

    $action = $_POST['request'];

    $data=$_POST['data'];

    $activity->updateAcitivitySetScoreByProject($data);
}
if(isset($_POST['infoProjectDone'])){

    $project = new Projects;

    $id_project =$_POST['id_project'];

    $project->getInfoProjectDone($id_project);
}

// crear actividad
if(isset($_POST['createActivity'])){
    $data = $_POST;
    
   
    $activity = new Activities;

    $activity->createActivity($data); 

    // $activity->updateAcitivitySetScoreByProject($data);
}










