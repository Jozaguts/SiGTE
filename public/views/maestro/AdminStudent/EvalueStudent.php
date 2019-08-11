<?php namespace AdminStudent;
require './../../autoload.php';
require './../../../Database/Students.php';
// require './../../../Database/Projects.php';
// require './../../../Database/Teams.php';
use DataBase\Students;
use Components\Header;
// use DataBase\Projects;
// use DataBase\Teams;

session_start();
$user_type = $_SESSION['user_type_id'];

$header = new Header;
$header->getHeader('Evaluar Alumno');


// obtengo los estudiantes que no tengan equipo asignado
$students = new Students;
$arrayResponse= $students->getStudentsWithAssignedActivities();

// // obtengo los proyectos
// $projects = new Projects;
// $arrayProjects = $projects->getProjects();

// // obtengo los Equipos
// $teams = new Teams;
// $arrayTeams = $teams->getTeams();




echo '<div class="form-create-student-container">
    <form class="form-create-student-container__form">

        <div class="form-create-student-container-form__inputs-container">

        <h2 class="form-create-student-container-form__title">Activiades Asignadas</h2>

            <div class="input-container">
                <small class="small-name">   </small>
                <select name="alumno" id="alumno" class="" > 
                <option value="false">Elija a un Alumno</option> ';
                    foreach ($arrayResponse as $student) {
                        echo '<option value="'.$student['user_id'].'">'.$student['username'].' </option>';
                    }
                echo'</select>
                <small class="small-message">   </small>
            </div>
            <table>
            <thead>
                <tr>
                <th>Nombre de la Actividad</th>
                <th>Completada</th>
                <th>Calificacón</th>
                </tr>
            </thead>
            <tbody id="tbody";>
                <tr>
                <td>January</td>
                <td>$100</td>
                </tr>
                <tr>
                <td>February</td>
                <td>$80</td>
                </tr>
            </tbody>
            
            </table>
            
            
            </table>

            
            
            
            
        </div>
        
        <div class="form-create-student-container-form-button-container">
        <button class="form-assing-student-container-form-container__button">Aceptar</button>
        </div>
    </form>
    </div>';



