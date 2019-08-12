<?php namespace Components;

class NavbarComponent {

    function getNavbar($user_type){

        
       
        switch ($user_type) {
            
            case 1:
            $liItems = array( 0=> 'studens-icon studens-icon_teacher ',1=>'team-icon team-icon_teacher',2=>'project-icon project-icon_teacher',3=>'message-icon message-icon_teacher');
                $genertaLi = $this->generateLi($liItems);
                break;
            case 2:
            $liItems = array( 0=>'team-icon team-icon_leader',1=>'project-icon project-icon_leader',2=>'message-icon message-icon_leader');
                $genertaLi= $this->generateLi($liItems);
                break;
            case 3:
            $liItems = array( 0=>'project-icon project-icon_member',1=>'message-icon message-icon_member');
                $genertaLi= $this->generateLi($liItems);
                break; 
        }

    }
    function generateLi($liItems){
        echo '<nav class="main-nav">';
        echo '<ul class=main-list>';
            for ($i=0; $i <count($liItems); $i++) { 
        echo '<li class="'.$liItems[$i].' main-list__item "></li>';
      }
      echo'</ul>';
        echo '</nav>';
    }

}