<?php
require ('../../../autoload.php');

use Components\Alert;
session_start();
$message=$_SESSION['alert'];

$alert = new Alert;
$link = array('maestro/AdminProject/RegisterProject','home') ;
$alert->getSuccessAlert($message, $link);
