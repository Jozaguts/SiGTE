<?php namespace Components;

class NavbarComponent {

    function getNavbar($user_type){

        
       
        switch ($user_type) {
            
            case 0:
            $liItems = array( 0=> 'studens-icon',1=>'team-icon',2=>'project-icon',3=>'message-icon');
                $genertaLi = $this->generateLi($liItems);
                break;
            case 1:
            $liItems = array( 0=>'team-icon',1=>'project-icon',2=>'message-icon');
                $genertaLi= $this->generateLi($liItems);
                break;
            case 2:
            $liItems = array( 0=>'project-icon',1=>'message-icon');
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