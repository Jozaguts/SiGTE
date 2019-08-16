<?php 
require './../../autoload.php';
require './../../../Database/Projects.php';
use DataBase\Projects;

use Components\Header;
session_start();
$user_type = $_SESSION['user_type_id'];
$header = new Header;

$header->getHeader('Menú');

$project = new Projects;

$arrayProjects = $project->getProjects();
// $arrayTeams = $project->showTeamsByProject();



$arrayFiles = array( 0 =>'PDF', 1=> 'DOC', 2=> '.EXE',3=>'EXCEL',4=>'POWER POINT');

echo '<div class="form-create-student-container">
    <form class="form-create-student-container__form">

        <div class="form-create-student-container-form__inputs-container">

            <h2 class="form-create-student-container-form__title">Crear Actividades</h2>

            <div class="input-container">
            <small class="small-name">   </small>
            <select name="project" id="project" class="" >

            <option value="false" >Elija a un proyecto</option> ';
                foreach ($arrayProjects as $file =>$key) {
                    echo '<option value="'.$key['id_project'].'">'.$key['name_project'].' </option>';
                }
        echo'</select>
            <small class="small-message">   </small>
            </div>
            <div class="input-container">
            <small class="small-name">   </small>
            <select name="project" id="project" class="" >

            <option value="false" >Elija un Equipo</option> ';

        echo'</select>
            <small class="small-message">   </small>
        </div>
            <div class="input-container">
                <small class="small-name">   </small>
                <input type="text" name="name_project" id="name_project" placeholder="Nombre de la Actividad"  required>
                <small class="small-message">   </small>
            </div>
        

            <div class="input-container">
                <small class="small-name">   </small>
                <select name="file" id="file" class="" >

                <option value="false" >Archivo Final</option> ';
                    foreach ($arrayFiles as $file =>$key) {
                        echo '<option value="'.$file.'">'.$key.' </option>';
                    }
            echo'</select>
                <small class="small-message">   </small>
            </div>
       
            <div class="input-container">
                <small class="small-name">   </small>
                <textarea name="comments" id="comments" cols="30" rows="10" placeholder="Comentarios"></textarea>
                <small class="small-message">   </small>
            </div>
         
        </div>
        
        <div class="form-create-student-container-form-button-container">
        <button class="form-create-student-container-form-container__button_create-activity-project ">Aceptar</button>
        </div>
    </form>
    </div>';




