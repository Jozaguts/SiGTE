<?php
require './../../autoload.php';
require './../../../Database/Projects.php';
use DataBase\Projects;

use Components\Header;

session_start();
$user_type = $_SESSION['user_type_id'];
$header = new Header;
$projects = new Projects;


// Mostrar solo proyectos terminados status project == Done (D)

$arrayProjects =  $projects->showProjectsDone();

$header->getHeader('Menú');




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

            <div class="datagrid-informe">
                    
            <div class="column-tags">
                <h3 class="title"> Nombre del Proyecto </h3>
                <h3 class="title"> Fecha Final De Entrega </h3>
                <h3 class="title"> Equipo </h3>
                <h3 class="title"> Lider de Equipo </h3>
                <h3 class="title"> Calificación</h3>
                
            </div>
            <div class="column-info" >
      
            </div>
            

    </div>   
    <div class="input-container" id="buttonTable">
    
    </div>

          
         
         
        </div>
        
        <div class="form-create-student-container-form-button-container">
        <button class="form-create-student-container-form-container__button_create-project ">Aceptar</button>
        </div>
    </form>
    </div>';