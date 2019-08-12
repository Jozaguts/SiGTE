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
$arrayProjects = $project->getProjectswithActivities();

echo '<div class="form-create-student-container">
    <form class="form-create-student-container__form">

        <div class="form-create-student-container-form__inputs-container">

            <h2 class="form-create-student-container-form__title">Avances y Evidencias de Proyectos</h2>

            <div class="input-container">
                <small class="small-name">   </small>
                <select name="proyectoEvidence" id="proyectoEvidence" class="" > 
                <option value="false">Elija un Proyecto</option> ';
                    foreach ($arrayProjects as $project) {
                        echo '<option value="'.$project['id_project'].'">'.$project['name_project'].' </option>';
                    }
                echo'</select>
                <small class="small-message">   </small>
            </div>

            <div class="input-container" >
            <small class="small-name">   </small>
            <select name="proyectoEvidence"  id="activityEvidence">
            <option value="false">Elija una actividad</option> 
                
            
            </select>';
            echo '<small class="small-message">   </small>
            </div>

            <div class="input-container" >
            <h1>Informe</h1>

                    <div class="datagrid-informe">
                    
                    <div class="column-tags">
                        <h3 class="title"> Nombre del equipo </h3>
                        <h3 class="title"> Alumno </h3>
                        <h3 class="title"> Actividad Status </h3>
                        <h3 class="title"> Tipo de Archivo </h3>
                    </div>
                    <div class="column-info" >
              
                    </div>
                    </div>

            </div>   
            <div class="input-container" id="buttonTable">
            
            </div>



        </div>

     
        
        <div class="form-create-student-container-form-button-container">
            <button class="form-create-student-container-form-container__button_get-evidence-project ">Aceptar</button>
        </div>
    </form>
    </div>';