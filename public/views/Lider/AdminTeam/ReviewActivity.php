<?php
require './../../autoload.php';
require '../../../Database/Activities.php';

use Components\Header;
use DataBase\Activities;
$header = new Header;
$activity = new Activities;

session_start();
$user_type = $_SESSION['user_type_id'];
$user_id =$_SESSION['user_id'];
(int)$user_id;

$header->getHeader('Menú');

$arrayActivities = $activity->getActivitiesByUser($user_id);



echo '<div class="form-create-student-container">
    <form class="form-create-student-container__form">

        <div class="form-create-student-container-form__inputs-container">

            <h2 class="form-create-student-container-form__title">Actividades Asignadas</h2>
            
            <div class="activities-container">


            <div class="input-container">
            <small class="small-name">   </small>
            <select name="activity" id="activity" class="show-info-activity" > 
            <option value="false">Elije una Actividad</option> ';
                foreach ($arrayActivities as $activitiInfo) {
                    echo '<option value="'.$activitiInfo['id_activity'].'">'.$activitiInfo['name_activity'].' </option>';
                }
            echo'</select>
            <small class="small-message">   </small>
        </div>
       
            
            
            </div>
            <div class="container-ul">
        <ul>
        <li>Actividad</li>
        <li>Descripcion</li>
        <li>Link</li>
        <li>Responsable</li>
        </ul>
        
        <ul class="data-activity">
        
        
        </ul>

           
            </div>

           
        </div>
            <div class="form-create-student-container-form-button-container">
                <button class="form-assing-student-container__send_valitation ">Aceptar</button>
            </div>
    </form>
    </div>';