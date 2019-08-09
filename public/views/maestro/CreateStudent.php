<?php namespace Maestro;

use Components\Header;


require ('../autoload.php');
session_start();
$user_type = $_SESSION['user_type_id'];
$header = new Header;

$header->getHeader('Menú');

echo '<div class="form-create-student-container">
    <form class="form-create-student-container__form">

        <div class="form-create-student-container-form__inputs-container">

            <h2 class="form-create-student-container-form__title">Alta de Alumno</h2>

            <input type="text" name="name" id="name" placeholder="Nombre">

            <input type="text" name="paternal_name" id="paternal_name" placeholder="Apellido Paterno">

            <input type="text" name="maternal_name" id="maternal_name" placeholder="Apellido Materno">
            
            <input type="text" name="email" id="email" placeholder="Correo Electronico">
        </div>
        
        <div class=" form-create-student-container-form-button-container"></div>
        <button class="form-create-student-container-form-container__button">Aceptar</button>
    </form>
    </div>';



