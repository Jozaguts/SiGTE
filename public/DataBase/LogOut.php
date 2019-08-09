<?php namespace DataBase;
require 'Conection.php';

session_start(); 
session_destroy();

echo json_encode('Sesión Cerrada');