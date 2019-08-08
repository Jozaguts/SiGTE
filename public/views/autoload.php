<?php

spl_autoload_register(function($name){
    
    require $ruta =  $name .'.php';

});