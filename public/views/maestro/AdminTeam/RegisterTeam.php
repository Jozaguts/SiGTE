<?php namespace AdminStudent;

use Components\Header;


require ('../../autoload.php');
session_start();
$user_type = $_SESSION['user_type_id'];
$header = new Header;

$header->getHeader('Menú');


echo '<div class="form-create-student-container">
    <form class="form-create-student-container__form">

        <div class="form-create-student-container-form__inputs-container">

            <h2 class="form-create-student-container-form__title">Registrar Equipo</h2>

            <div class="input-container">
                <small class="small-name">   </small>
                <input type="text" name="cod_team" id="cod_team" placeholder="Codigo de Equipo"  required>
                <small class="small-message">   </small>
            </div>
            <div class="input-container">
                <small class="small-name">   </small>
                <input type="text" name="name_team" id="name_team" placeholder="Nombre de Equipo">
                <small class="small-message">   </small>
            </div>
            <div class="input-container">
            <small class="small-name">   </small>
            <input type="number" name="max_students" id="max_students" placeholder="Numero Máximo de Estudiantes">
            <small class="small-message">   </small>
        </div>
         
        </div>
        
        <div class="form-create-student-container-form-button-container">
        <button class="form-create-student-container-form-container__button_create-team ">Aceptar</button>
        </div>
    </form>
    </div>';




