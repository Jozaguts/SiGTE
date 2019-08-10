<?php
require ('../../../autoload.php');

use Components\Alert;
session_start();
$message=$_SESSION['alert'];

$alert = new Alert;

$alert->getSuccessAlert($message);
