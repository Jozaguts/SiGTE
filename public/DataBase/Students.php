<?php namespace DataBase;

require_once 'Conection.php';
$_POST = json_decode(file_get_contents('php://input'), true);


class Students {
    
    function getStudents() {
        $connection = new Conection;
        
        // consulta solo para traer los alumnos que no has sido asignados y al maestro TODOS ESTAN EN LA TABLA USER
        $query="SELECT name, user_id, paternal_name, maternal_name, user_type_id,username, id_team from user where user_type_id != 1 ;";
    //    se ejecuta la consulta si falla se mata el proceso
        $response = mysqli_query($connection->Connect(), $query) or die("Error de Consulta" . mysqli_error($connection->Connect()));
        // obtengo el numero de columnas de la respuesta que da la base de datos
        $rowsCoutn = mysqli_num_rows($response);

     

        if ($rowsCoutn == 0) {
            return json_encode(" No hay alumnos resistrados");
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
    // $id_project =$data['id_project']; 
    $is_leader= $data['leader'];
    (int)$id_user;
    (int)$id_team;
    // (int)$id_project;
    $boolean = (bool)$is_leader;

    $connection = new Conection;
    
    //  consulta solo para traer los alumnos que no has sido asignados y al maestro TODOS ESTAN EN LA TABLA USER
    $query= "INSERT INTO student_team (id_user, id_team,is_leader) VALUES($id_user,$id_team,$boolean)";
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


        $connection = new Conection;
        
        // consulta solo para traer los alumnos que no has sido asignados y al maestro TODOS ESTAN EN LA TABLA USER
        $query=
        "SELECT DISTINCT username, user_id
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

                array_push($students, array(
                    "username" => $row['username'],
                    "user_id" => $row['user_id']  
                ));
            }
        //  si quiero regesarlo a JS
            // $jsonRespose = json_encode($Teams);
            // me brinco el paso de js y lo pinto mandanlo directamet al archivo que lo necesita
            
            return $students; 

           
        }
    }

    function getInfoUserById($idStudent){

        $connection = new Conection;
        
        // consulta solo para traer los alumnos que no has sido asignados y al maestro TODOS ESTAN EN LA TABLA USER
        $query="SELECT name, user_id, paternal_name, maternal_name, user_type_id,username, id_team,password from user where user_id = $idStudent;";
    //    se ejecuta la consulta si falla se mata el proceso
        $response = mysqli_query($connection->Connect(), $query) or die("Error de Consulta" . mysqli_error($connection->Connect()));
        // obtengo el numero de columnas de la respuesta que da la base de datos
        $rowsCoutn = mysqli_num_rows($response);

     

        if ($rowsCoutn == 0) {
            return json_encode(" No hay alumnos resistrados");
        }else{
            $students = array();
             while ($row = mysqli_fetch_array($response)) {

                array_push($students, array(
                    "Nombre" => $row['name'],
                    "Apellido Paterno" => $row['paternal_name'],
                     "Apellido Materno" => $row['maternal_name'],
                     "Nombre de Usuario" => $row['username'],
                     "user_id" => $row['user_id'],
                     "id_team"=> $row['id_team'],
                     "Tipo de Usuario" => $row['user_type_id'],
                     "Contraseña" => $row['password']

                ));
        
               

            }
        //  si quiero regesarlo a JS
        echo json_encode($students);
            // me brinco el paso de js y lo pinto mandanlo directamet al archivo que lo necesita
            // return $students; 

           
        }
        mysqli_close($connection->Connect());

    //     // var_dump($user_id);

    //     $connection = new Conection;
        
    //     // consualta para traer las actividades asignadas a un cierto ID
    //     $query=
    //     "SELECT DISTINCT name_activity, status_activity, score,id_activity, id_user
    //     from activity
    //     where id_user = $idStudent;";
    //     // WHERE user_id = $user_id";
   
    // //    se ejecuta la consulta si falla se mata el proceso
    //     $response = mysqli_query($connection->Connect(), $query) or die("Error de Consulta" . mysqli_error($connection->Connect()));
    //     // obtengo el numero de columnas de la respuesta que da la base de datos
    //     $rowsCoutn = mysqli_num_rows($response);

     

    //     if ($rowsCoutn == 0) {
    //         echo "Alumno sin Actividades";
    //     }else{
    //         $activities = array();
    //          while ($row = mysqli_fetch_array($response)) {

    //             array_push($activities, array(
    //                 "name_activity" => $row['name_activity'],
    //                 "id_activity" => $row['id_activity'],
    //                 "id_user" => $row['id_user'],
    //                 "status_activity" => $row['status_activity'],
    //                 "score" => $row['score']  
    //             ));
    //         }
    //     //  si quiero regesarlo a JS
    //         $jsonRespose = json_encode($activities);
    //         echo $jsonRespose;
    //         // me brinco el paso de js y lo pinto mandanlo directamet al archivo que lo necesita
            
    //         // return $activities; 

           
    //     }
    }
    function SetScoreStudent($array){

        foreach ($array as $key ) {
            $connection = new Conection;

            $user_id= $key['user_id'];
            $id_activity= $key['id_activity'];
            $score = $key['score'];

            (int)$user_id;
            (int)$id_activity;
            (int)$score;
            

            $query= "UPDATE activity
            SET score = $score
            WHERE id_user = $user_id AND id_activity = $id_activity;";

     $response = mysqli_query($connection->Connect(), $query) or die("Error de Consulta" . mysqli_error($connection->Connect()));

     if ($response == 0) {
       $res = "No se actualizo Alumno";
       echo json_encode($res); 
   }else{
   

       mysqli_close($connection->Connect());
  
      
   }
        }

        $_SESSION['alert'] =  'Alumno Evaluado Correctamente';

        $res = "Alumno Calificado";
        echo json_encode($res);
    }

    // funcion del Profesor actualizar o modificar alumno

    public function updateUser($data){

        $name = $data['name'];
        $username = $data['username'];
        $maternal_name = $data['maternal_name'];
       $user_type_id = $data['user_type_id'];
        $username = $data['username'];
        $user_id = $data['user_id'];
        $password = $data['password'];
        (int)$user_id;
        (int)$user_type_id;
        // var_dump($data);
        

 $connection = new Conection;

 $query =" UPDATE user 
        set name = '$name',
            paternal_name = '$username',
            maternal_name = '$maternal_name',
            user_type_id = $user_type_id,
            username= '$username',
            password = '$password'
        where 
            user_id = $user_id";

  $response = mysqli_query($connection->Connect(), $query) or die("Error de Consulta" . mysqli_error($connection->Connect()));

        if($response == 0) {
            $message ="Error al Actulizar";
            echo json_encode($message);
            mysqli_close($connection->Connect());
        }else{

            $message = "Alumno Editado!";
            session_start();
            $_SESSION['alert'] = $message;
            echo json_encode($message);
            mysqli_close($connection->Connect());
        }
       



    }
    public function deleleStudent($id){
     

   
        $user_id = (int)$id;
     
        $con = new Conection;
        
        $query ="DELETE from `user` where `user_id` = $user_id";

        $response = mysqli_query($con->Connect(),$query) or die("Error en la consulta". mysqli_error($con->Connect()));

  
        if($response==0){

            $message = "No Se Elimino El Alumno";
            session_start();
            $_SESSION['alert']=$message;

            echo json_encode($message);

            mysqli_close($con->Connect());

        }else{
            $message = "Se Elimno Alumno Exitosamente";
            session_start();
            $_SESSION['alert']=$message;

            echo json_encode($message);

            mysqli_close($con->Connect());
        }




    }




}