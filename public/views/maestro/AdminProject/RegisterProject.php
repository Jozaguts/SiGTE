<?php
require './../../autoload.php';

use Components\Header;
session_start();
$user_type = $_SESSION['user_type_id'];
$header = new Header;

$header->getHeader('Menú');

$arrayFiles = array( 0 =>'PDF', 1=> 'DOC', 2=> '.EXE',3=>'EXCEL',4=>'POWER POINT');


echo '<div class="form-create-student-container">
    <form class="form-create-student-container__form">

        <div class="form-create-student-container-form__inputs-container">

            <h2 class="form-create-student-container-form__title">Registrar Proyecto</h2>

            <div class="input-container">
                <small class="small-name">   </small>
                <input type="text" name="name_project" id="name_project" placeholder="Nombre del Proyecto"  required>
                <small class="small-message">   </small>
            </div>
        

            <div class="input-container">
                <small class="small-name">   </small>
                <select name="file" id="file" class="" >

                <option value="false" >Archivo Final</option> ';
                    foreach ($arrayFiles as $file =>$key) {
                        echo '<option value="'.$file.'">'.$key.' </option>';
                    }
            echo'</select>
                <small class="small-message">   </small>
            </div>
            <div class="input-container">
                <small class="small-name">   </small>
                <input type="date" name="endDate" id="endDate">
                <small class="small-message">   </small>
            </div>
            <div class="input-container">
                <small class="small-name">   </small>
                <textarea name="comments" id="comments" cols="30" rows="10" placeholder="Comentarios"></textarea>
                <small class="small-message">   </small>
            </div>
         
        </div>
        
        <div class="form-create-student-container-form-button-container">
        <button class="form-create-student-container-form-container__button_create-project ">Aceptar</button>
        </div>
    </form>
    </div>';