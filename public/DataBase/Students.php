<?php namespace DataBase;

require_once 'Conection.php';
$_POST = json_decode(file_get_contents('php://input'), true);


class Students {
    
    function getStudents() {
        $connection = new Conection;
        
        // consulta solo para traer los alumnos que no has sido asignados y al maestro TODOS ESTAN EN LA TABLA USER
        $query="SELECT name, user_id, paternal_name, maternal_name, user_type_id,username, id_team from user where id_team is NULL and user_type_id != 1 ;";
    //    se ejecuta la consulta si falla se mata el proceso
        $response = mysqli_query($connection->Connect(), $query) or die("Error de Consulta" . mysqli_error($connection->Connect()));
        // obtengo el numero de columnas de la respuesta que da la base de datos
        $rowsCoutn = mysqli_num_rows($response);

     

        if ($rowsCoutn == 0) {
            echo "No hay alumnos resistrados";
        }else{
            $students = array();
             while ($row = mysqli_fetch_array($response)) {

                array_push($students, array(
                    "name" => $row['name'],
                    "paternal_name" => $row['paternal_name'],
                     "maternal_name" => $row['maternal_name'],
                     "username" => $row['username'],
                     "user_id" => $row['user_id'],
                     "id_team"=> $row['id_team'],
                     "user_type_id" => $row['user_type_id']

                ));
        
               

            }
        //  si quiero regesarlo a JS
            $jsonRespose = json_encode($students);
            // me brinco el paso de js y lo pinto mandanlo directamet al archivo que lo necesita
            return $students; 

           
        }
        mysqli_close($connection->Connect());
 }

 function assingStudent($data) {

    
    $id_user = $data['user_id'];  
    $id_team =$data['id_team']; 
    $id_project =$data['id_project']; 
    $is_leader= $data['leader'];
    (int)$id_user;
    (int)$id_team;
    (int)$id_project;
    $boolean = (bool)$is_leader;

    $connection = new Conection;
    
    //  consulta solo para traer los alumnos que no has sido asignados y al maestro TODOS ESTAN EN LA TABLA USER
    $query= "INSERT INTO student_team (id_user, id_team, id_project,is_leader) VALUES($id_user, $id_team, $id_project,$boolean )";
//    se ejecuta la consulta si falla se mata el proceso
    $response = mysqli_query($connection->Connect(), $query) or die("Error de Consulta" . mysqli_error($connection->Connect()));
    // obtengo el numero de columnas de la respuesta que da la base de datos
    // $rowsCoutn = mysqli_num_rows($response);


    if ($response == 0) {
        $res = "Error al Asignar alumno";
        echo json_encode($res); 
    }else{
       
        session_start();
        $_SESSION['alert'] =  'Alumno Asignado Correctamente';
        $res = "Alumno Asignado Correctamente";

        echo json_encode($res); 

        mysqli_close($connection->Connect());
        $updateIdTeam = $this->updateIdTeam($id_team,$id_user);
}
 
}
    function updateIdTeam($id_team,$id_user){

        $connection = new Conection;

     // actualizo la tabla alumnos para asignarli el id de su equipo
     $query= "UPDATE user
             SET id_team = $id_team
             WHERE user_id = $id_user;";
      $response = mysqli_query($connection->Connect(), $query) or die("Error de Consulta" . mysqli_error($connection->Connect()));

      if ($response == 0) {
        $res = "No se actualizo Alumno";
        echo json_encode($res); 
    }else{
        // $res = "Alumno Actualizado";
        // echo json_encode($res); 
        mysqli_close($connection->Connect());
    }
    } 


    function activityStudent($user_id){
        var_dump($user_id);

        $connection = new Conection;
        
        // consulta solo para traer los alumnos que no has sido asignados y al maestro TODOS ESTAN EN LA TABLA USER
        $query="SELECT name_activity, status_activity from activity where id_user = $user_id;";
    //    se ejecuta la consulta si falla se mata el proceso
        $response = mysqli_query($connection->Connect(), $query) or die("Error de Consulta" . mysqli_error($connection->Connect()));
        // obtengo el numero de columnas de la respuesta que da la base de datos
        $rowsCoutn = mysqli_num_rows($response);

     

        if ($rowsCoutn == 0) {
            echo "No hay alumnos resistrados";
        }else{
            echo "Funciona";
        }

    }
    function getStudentsWithAssignedActivities() {
        // var_dump($user_id);

        $connection = new Conection;
        
        // consulta solo para traer los alumnos que no has sido asignados y al maestro TODOS ESTAN EN LA TABLA USER
        $query=
        "SELECT username
        from `user`, activity
        where user.user_id = activity.id_user;";
        // WHERE user_id = $user_id";
   
    //    se ejecuta la consulta si falla se mata el proceso
        $response = mysqli_query($connection->Connect(), $query) or die("Error de Consulta" . mysqli_error($connection->Connect()));
        // obtengo el numero de columnas de la respuesta que da la base de datos
        $rowsCoutn = mysqli_num_rows($response);

     

        if ($rowsCoutn == 0) {
            echo "No hay Equipos Registrados";
        }else{
            $students = array();
             while ($row = mysqli_fetch_array($response)) {

                array_push($students, array( "username" => $row['username']));
            }
        //  si quiero regesarlo a JS
            // $jsonRespose = json_encode($Teams);
            // me brinco el paso de js y lo pinto mandanlo directamet al archivo que lo necesita
            
            return $students; 

           
        }
    }
}