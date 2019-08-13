<?php namespace Components;

class  MainComponent{

    function getMain($user_type){

  

        switch ($user_type) {
            
            case 1:
            $listActivitys = array( 0=> 'Alta de Alumno',1=>'Asignar Alumno',2=>'Editar Alumno');
                $generateActivities = $this->generateActivities($listActivitys);
                break;
            case 2:
            $listActivitys = array( 0=> 'Asignar Actividades');
            $generateActivities= $this->generateActivities($listActivitys);
                break;
            case 3:
            $listActivitys = array( 0=> 'Actividades Asignadas',1=>'Enviar Evidencia');
                $generateActivities= $this->generateActivities($listActivitys);
                break; 
        }
    }

    function generateActivities($listActivitys){
       
        echo '<main class="main-content-container">';
        echo '<span class="go-back-icon-container"><i class="go-back-icon"></i></span>';
        echo '<ul class="main-content-container__list">';
            for ($i=0; $i <count($listActivitys); $i++) { 
                $class = str_replace(" ", "-", $listActivitys[$i]);
                $event = str_replace(" ", "", $listActivitys[$i]);
        echo '<li class="main-content-container-list__item '.$class.' onclick='.$event.'()">'.$listActivitys[$i].'</li>';
      }
      echo'</ul>';
      echo '</main>';

    }
    }
    
