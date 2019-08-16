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
    <form class="form-create-student-container__form" method="POST" id="uploadFile">

        <div class="form-create-student-container-form__inputs-container">

            <h2 class="form-create-student-container-form__title">Enviar Actividades</h2>
            
            <div class="input-container">
                <small class="small-name">   </small>
                <input type="file" name="evidence" id="evidence">
                <small class="small-message">   </small>

               
            </div>
            <div class="input-container">
            <small class="small-name">   </small>
            <select name="id_activity" id="id_activity">
            <option value="false" >elija una actividad</option>';
            foreach ($arrayActivities as $activity => $value)  {
                echo '<option value="'.$value['id_activity'].'">'.$value['name_activity'].' </option>';
            }
        echo'</select>
            <small class="small-message">   </small>

           
            </div>
            <div class="input-container">
          
            <button type="submit" class="btn-send" >Enviar</button>
        
            </div>
           

        </div>

     
        
     
    </form>
    </div>';