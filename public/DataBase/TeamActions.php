<?php
require_once 'Conection.php';

require 'Projects.php';
$_POST = json_decode(file_get_contents('php://input'), true);
use DataBase\Projects;


/* 
Sí pasa la validacion busco en base de datos los proyectos que no tengas equipo asignado
no busco directamete en este archivo aquí mando a llamar a la funcions que se encarga de ello
 */

if( isset($_POST['selectforGetProjects']) ){
    
    $projects = new Projects;
    
    $projects->getProjectsWithOutTeam();   

}


if( isset($_POST['assingTeamToProject']) ) {
    
    $id_team = $_POST['id_team'];
    $id_project= $_POST['id_project'];
        
        $project = new Projects;
        $project->updateProjectSetTeam($id_team,$id_project);

}
