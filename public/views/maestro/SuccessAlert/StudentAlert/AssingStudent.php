<?php
require ('../../../autoload.php');

use Components\Alert;
session_start();
$message=$_SESSION['alert'];

$alert = new Alert;
$link2 = array('maestro/AdminStudent/AssignStudent','home') ;
$alert->getSuccessAlert($message, $link2);