<?php

function autoload($clase){
  
require("./".$clase.".php");
}

spl_autoload_register('autoload');

?>