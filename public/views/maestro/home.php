<?php namespace Maestro;
// requiero el auto cargador de clases
require ('../autoload.php');
session_start();
$user_type = $_SESSION['user_type_id'];

// var_dump($user_type);
// uso mis clases
use Components\Footer;
// use Components\Header;
use Components\NavbarComponent;
use Components\MainComponent;

// instancia de clases 
$footer = new Footer;
// $header =  new Header;
$main = new MainComponent;
$navBar= new NavbarComponent;

$navBar->getNavbar($user_type);
// implemeto metodos
$main->getMain($user_type);
$footer->getMainFooter($user_type);








