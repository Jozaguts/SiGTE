<?php namespace DataBase;
require_once 'Conection.php';
$_POST = json_decode(file_get_contents('php://input'), true);
require 'Teams.php';

use DataBase\Teams;

$teams = new Teams;

$cod_team  = $_POST['cod_team'];
$name_team = $_POST['name_team'];
$max_students = $_POST['max_students'];


$teams->setTeam($name_team,$cod_team,$max_students);
 

