<?php namespace DataBase;


require_once 'Conection.php';

class Projects {
    
    function getProjects() {
        $connection = new Conection;
        
        // consulta solo para traer los projectos 
        $query="SELECT id_project, name_project from project;";
    //    se ejecuta la consulta si falla se mata el proceso
        $response = mysqli_query($connection->Connect(), $query) or die("Error de Consulta" . mysqli_error($connection->Connect()));
        // obtengo el numero de columnas de la respuesta que da la base de datos
        $rowsCoutn = mysqli_num_rows($response);

     

        if ($rowsCoutn == 0) {
            echo "No hay Proyectos Registrados";
        }else{
            $projects = array();
             while ($row = mysqli_fetch_array($response)) {

                array_push($projects, array(
                    "id_project" => $row['id_project'],
                    "name_project" => $row['name_project']
                ));
        
               

            }
        //  si quiero regesarlo a JS
            // $jsonRespose = json_encode($projects);
            // me brinco el paso de js y lo pinto mandanlo directamet al archivo que lo necesita
            
            return $projects; 

           
        }
        mysqli_close($connection->Connect());
 }
}