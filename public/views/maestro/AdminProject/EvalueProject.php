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

echo '<div class="form-create-student-container">
    <form class="form-create-student-container__form">

        <div class="form-create-student-container-form__inputs-container">

            <h2 class="form-create-student-container-form__title">Evaluar Proyectos</h2>

            <div class="input-container">
                <small class="small-name">   </small>
                <select name="evalueProject" id="evalueProject" class="select-eval-project" > 
                <option value="false">Elija un Proyecto</option> ';
                    foreach ($arrayProjects as $project) {
                        echo '<option value="'.$project['id_project'].'">'.$project['name_project'].' </option>';
                    }
                echo'</select>
                <small class="small-message">   </small>
            </div>

            <h2 class="form-create-student-container-form__title">Actividades Asignadas</h2>


            <table>
            <thead>
                <tr>
                <th>Nombre de la Actividad</th>
                <th>Completada</th>
                <th>Calificacón</th>
                </tr>
            </thead>
            <tbody id="tbody";>
            
            </tbody>
            
            </table>
            
            
            </table>
           


        </div>

     
        
        <div class="form-create-student-container-form-button-container">
            <button class="form-create-student-container-form-container__button_get-evidence-project ">Aceptar</button>
        </div>
    </form>
    </div>';