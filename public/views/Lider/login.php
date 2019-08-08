<?php namespace Lider;
// requiero el auto cargador de clases
require '../autoload.php';

// uso mis clases
use Components\Footer;
use Components\Header;
use Components\LogoInputsLoginComponent;

// instancia de clases 
$footer = new Footer;
$header =  new Header;
$loginComponents= new LogoInputsLoginComponent;



// implemeto metodos
$footer->getFooter();
$header->getLoginHeader();
/* getComponents recibe el nivel o tipo de usuario
Maestro =0
Lider =1
Miembre =2
 */
$loginComponents->getComponents(1);





?>