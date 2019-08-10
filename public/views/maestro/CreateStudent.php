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

            <div class="input-container">
                <small class="small-name">   </small>
                <input type="text" name="name" id="name" placeholder="Nombre"  required>
                <small class="small-message">   </small>
            </div>
            <div class="input-container">
                <small class="small-name">   </small>
                <input type="text" name="paternal_name" id="paternal_name" placeholder="Apellido Paterno">
                <small class="small-message">   </small>
            </div>
            <div class="input-container">
                <small class="small-name">   </small>
                <input type="text" name="maternal_name" id="maternal_name" placeholder="Apellido Materno">
                <small class="small-message">   </small>
            </div>
            <div class="input-container">
                <small class="small-name">   </small>
                <input type="text" name="email" id="email" placeholder="Correo Electronico">
                <small class="small-message">   </small>
            </div>
            <div class="input-container">
                <small class="small-name">   </small>
                <input type="text" name="username" id="username" placeholder="Nombre de Usuario">
                <small class="small-message">   </small>
            </div>
            <div class="input-container">
                <small class="small-name">   </small>
                <input type="password" name="password" id="password" placeholder="Contraseña">
                <small class="small-message">   </small>
            </div>
        </div>
        
        <div class="form-create-student-container-form-button-container">
        <button class="form-create-student-container-form-container__button">Aceptar</button>
        </div>
    </form>
    </div>';



