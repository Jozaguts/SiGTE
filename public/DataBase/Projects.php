<?php namespace DataBase;

use mysqli;

require_once 'Conection.php';

class Projects {
    
    public function getProjects() {
        
        $connection = new Conection;

/*  consulta solo para traer los projectos 
    se ejecuta la consulta si falla se mata el proceso
    obtengo el numero de columnas de la respuesta que da la base de datos
*/ 
    $query="SELECT id_project, name_project from project;";

    $response = mysqli_query($connection->Connect(), $query) or die("Error de Consulta" . mysqli_error($connection->Connect()));

    $rowsCoutn = mysqli_num_rows($response);



    if ($rowsCoutn == 0) {
        echo "No hay Proyectos Registrados";
    } 
    else {
        $projects = array();
            while ($row = mysqli_fetch_array($response)) {

                array_push($projects, array( 
                                            "id_project" => $row['id_project'],
                                            "name_project" => $row['name_project']
                                            ));

    }
     /*  si quiero regesarlo a JS
        $jsonRespose = json_encode($projects);
        me brinco el paso de js y lo pinto mandanlo directamet al archivo que lo necesita
      */

    return $projects; 
    mysqli_close($connection->Connect());
    }
 }

    public function getProjectswithActivities() {

    $connection = new Conection;
    
    // consulta solo para traer los projectos 
    $query="SELECT  distinct p.id_project, p.name_project 
    from project as p, activity as a 
    where  a.id_project = p.id_project;";
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

    public function setProject($dataProject){

            $comment = $dataProject['comments'];
            $currentDate = date("Y/m/d");
            $status = "A";
            $endDate= $dataProject['endDate'];
            $file = $dataProject['file'];
            $name_project = $dataProject['name_project'];
            $score =0;


        $connection = new Conection;
        
        //  consulta solo para traer los alumnos que estan disponibles y al maestro TODOS ESTAN EN LA TABLA USER
        $query= "INSERT 
                INTO project 
                (name_project, start_date_project, end_date_project, status_project, description,file_project, score) values ('$name_project', '$currentDate','$endDate','$status','$comment','$file',$score);";
    //    se ejecuta la consulta si falla se mata el proceso
        $response = mysqli_query($connection->Connect(), $query) or die("Error de Consulta" . mysqli_error($connection->Connect()));
        // obtengo el numero de columnas de la respuesta que da la base de datos
        // $rowsCoutn = mysqli_num_rows($response);


        if ($response == 0) {
            $res = "Error al Registrar el Proyecto";
            echo json_encode($res); 
        }else{
        
            session_start();
            $_SESSION['alert'] =  'Proyecto Registrado Correctamente';
            $res = "Proyecto Registrado Correctamente";

            echo json_encode($res); 

            mysqli_close($connection->Connect());
        
    }
 

    
 }
/* 
 funcion para el el modulo de asignar equipo a un proyecto 
 ne realiza una busqueda a base de datos de los proyectos que no tengan equipo asignado
 para mostrarlos en pantalla */

 public function getProjectsWithOutTeam(){


    $connection = new Conection;

    $query = "SELECT id_project, name_project FROM project where project.team_id is null;";

    $response = mysqli_query($connection->Connect(), $query) or die("Error de Consulta" . mysqli_error($connection->Connect()));

    $rowsCoutn = mysqli_num_rows($response);

        if ($rowsCoutn == 0) {
            $message = "No hay Projectos Disponibles para asignar";
            echo json_encode($message);
        }
        else{
            $projects = array();

            while ($row = mysqli_fetch_array($response)) {
                array_push($projects, array(
                    "id_project" => $row['id_project'],
                    "name_project" => $row['name_project']
                ));
                  
            }
            $res= json_encode($projects);
             echo $res;
            
            
        }
    }

    public function updateProjectSetTeam($id_team,$id_project){

        (int)$id_project;
        (int)$id_team;

        $con = new Conection;

        $query = "UPDATE project set team_id = $id_team where id_project = $id_project;";

        $response = mysqli_query($con->Connect(),$query) or die ("Error En la Consulta" . mysqli_error($con->Connect()));

        if ($response == 0) {
            $message = "No se actualizaron los datos";
            echo json_encode($message);
        }else{
            $message = "Equipo Asignado";
            echo json_encode($message);
            session_start();
            $_SESSION['alert'] = $message;

            mysqli_close($con->Connect());
        }


    }

    public function showProjectsDone(){


        $con = new Conection;

        $query =  "SELECT id_project, name_project FROM project where status_project = 'D';";

        $response  = mysqli_query($con->Connect(),$query) or die ("Error en la Consulta".mysqli_errno($con->Connect()));

        $rowsCoutn = mysqli_num_rows($response);

        if ($rowsCoutn == 0) {
            $message = "No hay Projectos Disponibles Mostrar";
            echo json_encode($message);
        }
        else{
            $projects = array();

            while ($row = mysqli_fetch_array($response)) {
                array_push($projects, array(
                    "id_project" => $row['id_project'],
                    "name_project" => $row['name_project']
                ));
                  
            }
            return  $projects;
            
        }



    }

    public function getInfoProjectDone($id_project){
        $con = new Conection;
       (int)$id_project;


        $query = "SELECT p.name_project, p.score, p.end_date_project, u.username, t.name_team, p.final_file_project
        from project as p 
        inner join team as t
        on 
        p.team_id = t.id_team
        inner join
        user as u 
        on 
        t.id_leader = u.user_id
        where p.id_project = $id_project;";



         $response  = mysqli_query($con->Connect(),$query) or die ("Error en la Consulta".mysqli_errno($con->Connect()));

        $rowsCoutn = mysqli_num_rows($response);

        if ($rowsCoutn == 0) {
            $message = "No hay Informacion Disponible Para Mostrar";
            echo json_encode($message);
        }
        else{
            $projects = array();

            while ($row = mysqli_fetch_array($response)) {
                array_push($projects, array(
                    "name_project" => $row['name_project'],
                    "score" => $row['score'],
                    "end_date_project" => $row['end_date_project'],
                    "username" => $row['username'],
                    "name_team" => $row['name_team'],
                    "final_file_project" => $row['final_file_project']
                ));
                  
            }

            echo json_encode($projects);
            // return  $projects;
            
        }



    }



}
