<?php namespace DataBase;
require_once 'Conection.php';

session_start(); 
session_destroy();

echo json_encode('Sesión Cerrada');