<?php
$_POST = json_decode(file_get_contents('php://input'), true);

require "Teams.php";

use DataBase\Teams;


$teams = new Teams;


$id= $_POST;

$teams->verifyLeaderTeam($id);