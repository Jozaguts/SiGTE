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


                <ul >';

            foreach ($arrayActivities as $key => $value) {
            echo " <li><span>Actividad:</span> ".$value['name_activity']."</li> 
                    <p><span>Descripción:</span>".$value['description_activity']."</p>
                    <p><span>Estado:</span>".$value['status_activity']."</p>
                    <hr>
            ";  
            }


              echo' </ul>
            
            
            </div>

            


         
           


        </div>

     
        
     
    </form>
    </div>';