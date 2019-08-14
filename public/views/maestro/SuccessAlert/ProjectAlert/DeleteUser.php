<?php
require ('../../../autoload.php');

use Components\Alert;
session_start();
$message=$_SESSION['alert'];

$alert = new Alert;
$link = array('maestro/AdminStudent/EditStudent','home') ;
$alert->getSuccessAlert($message, $link);
