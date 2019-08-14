<?php namespace Maestro;
// requiero el auto cargador de clases
require ('../autoload.php');

// uso mis clases
use Components\NavbarComponent;
use Components\Footer;


// instancia de clases 
$navBar= new NavbarComponent;
$footer= new Footer;


// implemeto metodos
$footer->getfooter();
$navBar->getNavbar("");
