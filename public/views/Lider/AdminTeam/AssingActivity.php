<?php namespace Lider;
// requiero el auto cargador de clases
require '../../autoload.php';
require './../../../Database/Teams.php';
session_start();
$user_type = $_SESSION['user_type_id'];

use Components\Header;
use DataBase\Teams;

$header = new Header;
$teams = new Teams;

$header->getHeader('Menú');


$arrayteams = $teams->getTeams();

echo '<div class="form-create-student-container">
    <form class="form-create-student-container__form">

        <div class="form-create-student-container-form__inputs-container">

            <h2 class="form-create-student-container-form__title">Asignar Actividades</h2>

            <div class="input-container">
                <small class="small-name">   </small>
                <select name="selectforGetProjects" id="selectforGetProjects"> 
                <option value="false">Elija un Equipo</option> ';
                    foreach ($arrayteams as $teams) {
                        echo '<option value="'.$teams['id_team'].'">'.$teams['name_team'].' </option>';
                    }
                echo'</select>
                <small class="small-message">   </small>
            </div>

            <div class="projects-container">
            
            
            
            </div>

            


         
           


        </div>

     
        
        <div class="form-create-student-container-form-button-container">
            <button class="form-create-student-container-form-container__assign-Team-To-Project">Aceptar</button>
        </div>
    </form>
    </div>';