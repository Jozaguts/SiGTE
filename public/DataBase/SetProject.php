<?php
require_once 'Conection.php';

$_POST = json_decode(file_get_contents('php://input'), true);

require_once 'Projects.php';
use DataBase\Projects;

$Projects = new Projects;

$Projects->setProject($_POST);




