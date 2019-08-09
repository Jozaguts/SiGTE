<?php namespace Components;

//  var_dump($_SESSION);
class Footer 
{
   
    public function getfooter()
    {
        echo '<footer class="animated fadeIn"> <h3>SiGTE</h3> </footer>';
    }
   
    public function getMainFooter($type_user=null){

        $name = $_SESSION['name'];
        $paternal_name =$_SESSION['paternal_name'];
        $maternal_name =$_SESSION['maternal_name'];
        $surnames= $paternal_name .' '.$maternal_name; 


        echo'<footer class="animated fadeIn">
                <div class="footer-content-contaier">
                    <div class="footer-icon-container"></div>
                    <div class="footer-info-container">
                        <h3 class="name-user">'.$name.'</h3>
                        <h4 class="surnames">'.$surnames.'</h4>
                    </div>
                    <div class="logout-icon"></div>
                </div>
            </footer>';
    }
    
}



