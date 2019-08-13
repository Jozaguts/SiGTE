<?php
require './../../autoload.php';
require './../../../Database/Projects.php';
use DataBase\Projects;

use Components\Header;

session_start();
$user_type = $_SESSION['user_type_id'];
$header = new Header;
$projects = new Projects;

$arrayProjects =  $projects->getProjects();

$header->getHeader('Menú');

// $arrayFiles = array( 0 =>'PDF', 1=> 'DOC', 2=> '.EXE',3=>'EXCEL',4=>'POWER POINT');


echo '<div class="form-create-student-container">
    <form class="form-create-student-container__form">

        <div class="form-create-student-container-form__inputs-container">

            <h2 class="form-create-student-container-form__title">Resultados de Proyecto</h2>

        
        

            <div class="input-container">
                <small class="small-name">   </small>
                <select name="projectResult" id="projectResult" class="" >

                <option value="false" >Elija un Proyecto</option> ';
                    foreach ($arrayProjects as $project) {
                        echo '<option value="'.$project['id_project'].'">'.$project['name_project'].' </option>';
                    }
            echo'</select>
                <small class="small-message">   </small>
            </div>
            <h1 class="form-create-student-container-form__title">Informe</h1>

          
         
         
        </div>
        
        <div class="form-create-student-container-form-button-container">
        <button class="form-create-student-container-form-container__button_create-project ">Aceptar</button>
        </div>
    </form>
    </div>';