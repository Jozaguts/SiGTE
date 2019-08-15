<?php namespace Lider;
// requiero el auto cargador de clases
require '../../autoload.php';
require './../../../Database/Students.php';
require './../../../Database/Activities.php';
session_start();
$user_type = $_SESSION['user_type_id'];
$idTeam = $_SESSION['id_team'];
var_dump($idTeam);


use Components\Header;
use DataBase\Students;
use DataBase\Activities;

$header = new Header;
$Students = new Students;
$Activities = new Activities;

$header->getHeader('Menú');


$arrayteams = $Students->getStudentsByTeam($idTeam);

$arrayActivities = $Activities->activitiesByTeam($idTeam);



echo '<div class="form-create-student-container">
    <form class="form-create-student-container__form">

        <div class="form-create-student-container-form__inputs-container">

            <h2 class="form-create-student-container-form__title">Asignar Actividades</h2>

            <div class="input-container">
                <small class="small-name">   </small>
                <select name="getActivityTeam" id="getActivityTeam"> 
                <option value="false">Elije una Actividad</option> ';
                    foreach ($arrayActivities as $teams) {
                        echo '<option value="'.$teams['id_activity'].'">'.$teams['name_activity'].' </option>';
                    }
                echo'</select>
                <small class="small-message">   </small>
            </div>
            <div class="input-container">
            <small class="small-name">   </small>
            <select name="getParnerTeam" id="getParnerTeam"> 
            <option value="false">Elije a un Compañero</option> ';
                foreach ($arrayteams as $teams) {
                    echo '<option value="'.$teams['user_id'].'">'.$teams['username'].' </option>';
                }
            echo'</select>
            <small class="small-message">   </small>
        </div>

            <div class="projects-container">
            
            
            
            
            </div>

            


         
           


        </div>

     
        
        <div class="form-create-student-container-form-button-container">
            <button class="form-create-student-container-form-container__assign-Activity-To-Parner">Aceptar</button>
        </div>
    </form>
    </div>';