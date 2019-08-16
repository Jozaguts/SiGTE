<?php namespace AdminStudent;
require './../../autoload.php';
require './../../../Database/Students.php';

require './../../../Database/Teams.php';
use DataBase\Students;
use Components\Header;

use DataBase\Teams;

session_start();
$user_type = $_SESSION['user_type_id'];

$header = new Header;
$header->getHeader('Menú');
$variable = array('valor 1', 'valor 2','valor 3', 'valor 4');

// obtengo los estudiantes que no tengan equipo asignado
$students = new Students;
$arrayResponse= $students->getStudents();


// obtengo los Equipos
$teams = new Teams;
$arrayTeams = $teams->getTeams();




echo '<div class="form-create-student-container">
    <form class="form-create-student-container__form">

        <div class="form-create-student-container-form__inputs-container">

            <h2 class="form-create-student-container-form__title">Asignar Alumno</h2>

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
            
         

            <div class="input-container">
                <small class="small-name">   </small>
                <select name="equipo" id="equipo" class="" onchange="equipoChange(this);" >
                <option value="false" >Elija un Equipo</option> ';
                    foreach ($arrayTeams as $team ) {
                        echo '<option value="'.$team['id_team'].'">'.$team['name_team'].' </option>';
                    }
            echo'</select>
                <small class="small-message">   </small>
            </div>
            <div class="input-container">
            <div class="is-leader-container">
                    <span class="question">¿Asignar Como Líder? </span>
                    <input type="radio" name="leader" id="si" value="true" disabled>
                    <input type="radio" name="leader" id="no" value="false" disabled>
            </div>
            
            </div>
            
        </div>
        
        <div class="form-create-student-container-form-button-container">
        <button class="form-assing-student-container-form-container__button">Aceptar</button>
        </div>
    </form>
    </div>';



