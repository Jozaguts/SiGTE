<?php namespace DataBase;
$_POST = json_decode(file_get_contents('php://input'), true);

require_once 'Conection.php';

class Teams {
    
    function getTeams() {
        $connection = new Conection;
        
        // consulta solo para traer los equipos 
        $query="SELECT id_team, name_team from team;";
    //    se ejecuta la consulta si falla se mata el proceso
        $response = mysqli_query($connection->Connect(), $query) or die("Error de Consulta" . mysqli_error($connection->Connect()));
        // obtengo el numero de columnas de la respuesta que da la base de datos
        $rowsCoutn = mysqli_num_rows($response);

    
        if ($rowsCoutn == 0) {
            echo "No hay Equipos Registrados";
        }else{
            $teams = array();
             while ($row = mysqli_fetch_array($response)) {

                array_push($teams, array(
                    "id_team" => $row['id_team'],
                    "name_team" => $row['name_team']
                ));
            }
        //  si quiero regesarlo a JS
            // $jsonRespose = json_encode($Teams);
            // me brinco el paso de js y lo pinto mandanlo directamet al archivo que lo necesita
            
            return $teams; 

           
        }
        mysqli_close($connection->Connect());
 }

 function setTeam($cod_team,$name_team) {


    $connection = new Conection;
    
    //  insertar un nuevo equipo
    $query = "INSERT INTO team (name_team, cod_team) VALUES ('$name_team', '$cod_team');";
//    se ejecuta la consulta si falla se mata el proceso
    $response = mysqli_query($connection->Connect(), $query) or die("Error de Consulta" . mysqli_error($connection->Connect()));
    // obtengo el numero de columnas de la respuesta que da la base de datos
    // $rowsCoutn = mysqli_num_rows($response);


    if ($response == 0) {
        $res = "Error al Asignar alumno";
        echo json_encode($res); 
    }else{
       
        session_start();
        $_SESSION['alert'] =  'Equipo Registrado Correctamente';
        $res = "Equipo Registrado Correctamente";

        echo json_encode($res); 

        mysqli_close($connection->Connect());
      
}

 }


}