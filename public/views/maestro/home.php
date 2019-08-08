<?php namespace Maestro;


require("../components/header.html");
?>

<div class="content" id="content">

<?php
  for ($i=0; $i < 4; $i++) 
  {
    echo "<div class='item-container animated fadeIn'> 
                <div class='text-content'> 
                    <p>     lorem Lorem ipsum dolor sit amet consectetur, adipisicing elit.             Illo temporibus 
                    </p>
                    <small> $i-$i  </small>
                </div>
                
                <div class='img-container'>   
                
                </div>
            </div>";
    ?>
   <?php
    }?>
</div>
<?php
include('../components/footer.html')
?>    

