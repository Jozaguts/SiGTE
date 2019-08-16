<?php namespace DataBase;

require_once 'Conection.php';
$_POST = json_decode(file_get_contents('php://input'), true);


class Activities {

    public function getActivitiesByProject($idProject){
    

        $connection = new Conection;
 
        $query="SELECT id_activity, name_activity, status_activity from activity where id_project = $idProject;";
    //    se ejecuta la consulta si falla se mata el proceso
        $response = mysqli_query($connection->Connect(), $query) or die("Error de Consulta" . mysqli_error($connection->Connect()));
        // obtengo el numero de columnas de la respuesta que da la base de datos
        $rowsCoutn = mysqli_num_rows($response);

     

        if ($rowsCoutn == 0) {

            $res = "No hay Actividades";
            echo json_encode($res);
        }else{
            $activities = array();
             while ($row = mysqli_fetch_array($response)) {

                array_push($activities, array(
                    "id_activity" => $row['id_activity'],
                    "status_activity" => $row['status_activity'],
                    "name_activity" => $row['name_activity']
                ));
        
               

            }
        //  si quiero regesarlo a JS
            $jsonRespose = json_encode($activities);
            echo  $jsonRespose;
            // me brinco el paso de js y lo pinto mandanlo directamet al archivo que lo necesita
            // return $activities; 

           
        }
        mysqli_close($connection->Connect());



    }



    public function getinfoActivity($idActivity, $idProject){

     

        $connection = new Conection;
        
     
        $query="SELECT a.status_activity, a.evidence_activity, u.username, a.file, t.name_team, t.id_team, a.name_activity
        FROM activity AS a 
        INNER JOIN
        `user` as u 
        on
        u.user_id = a.id_user and a.id_activity =$idActivity and a.evidence_activity is not null
        inner join
        team as t 
        on t.id_team = u.id_team 
        inner join
        project as p 
        on 
        p.id_project = $idProject;";
    //    se ejecuta la consulta si falla se mata el proceso
        $response = mysqli_query($connection->Connect(), $query) or die("Error de Consulta" . mysqli_error($connection->Connect()));
        // obtengo el numero de columnas de la respuesta que da la base de datos
        $rowsCoutn = mysqli_num_rows($response);

     

        if ($rowsCoutn == 0) {

            $res = "No hay Actividades";
            echo json_encode($res);
        }else{
            $activities = array();
             while ($row = mysqli_fetch_array($response)) {

                array_push($activities, array(
                    "status_activity" => $row['status_activity'],
                    "username" => $row['username'],
                    "file" => $row['file'],
                    "name_team"=>$row['name_team'],
                    "id_team" => $row['id_team'],
                    "name_activity" => $row['name_activity'],
                    "name_activity" => $row['name_activity'],
                    "url" => $row['evidence_activity']
                ));
        
               

            }
        //  si quiero regesarlo a JS
            $jsonRespose = json_encode($activities);
            echo  $jsonRespose;
            // me brinco el paso de js y lo pinto mandanlo directamet al archivo que lo necesita
            // return $activities; 

           
        }
        mysqli_close($connection->Connect());
    }

    public function updateAcitivitySetScoreByProject($data){
        // var_dump($data[0]);

        foreach ($data as $key => $value) {
            
            $id_activity = $value['id_activity'];
            $id_project = $value['id_project'];
            $score = $value['score'];


            (int)$id_activity;
            (int)$id_project;
            (int)$score;

            $con = new Conection;

            $query ="UPDATE activity SET score = $score WHERE id_project = $id_project and id_activity = $id_activity;";


            $respose  =  mysqli_query($con->Connect(), $query) or die ("Error de Consulta" . mysqli_error($con->Connect()));

            if($respose==0){
                $message = " NO hay datos Modificado";
                echo json_encode($message);
                mysqli_close($con->Connect());
            }else{
                
          
            }

        }
        $message = " Actividad Evaluada Con Exito";
        session_start();
        $_SESSION['alert'] = $message;
        echo json_encode($message);
        mysqli_close($con->Connect());
    }


    public function createActivity($data){

       
        $con = new Conection;
        $name_activity = $data['name_activity'];
        $file= $data['file'];
        $comments =$data['comments'];
        $status = "A";
        $idproject= $data['idproject'];

        // $idproject


        $query = "INSERT into activity 
        (name_activity,description_activity, file, status_activity, id_project,id_user,score,evidence_activity) 
        values ('$name_activity', '$comments','$file','$status', '$idproject' ,null, 0, null);";


        $response = mysqli_query($con->Connect(), $query) or die ("Erro de Consulta" . mysqli_error($con->Connect()));

       

        if($response==0){
            $message = " NO hay datos Modificado";
            echo json_encode($message);
            mysqli_close($con->Connect());
        }else{
            session_start();
            $message = "Actividad Creada";
            $_SESSION['alert']= $message;
            echo json_encode($message);
            mysqli_close($con->Connect());
        }


        
    }
    public function activitiesByTeam($id_team){

        $con = new Conection();

        $query="SELECT a.id_activity, a.name_activity 
        from activity as a, project_team as pt
        where a.id_project = pt.id_project and pt.id_team = $id_team ";

        $response = mysqli_query($con->Connect(), $query) or die ("Error en la consulta". mysqli_error
        ($con->Connect()));
        $rowsCoutn = mysqli_num_rows($response);

        if($rowsCoutn == 0){
            $message = " Equipo sin Actividades";
            echo json_encode($message);
            mysqli_close($con->Connect());
        }else{
            $activities = array();
             while ($row = mysqli_fetch_array($response)) {

                array_push($activities, array(
                    "id_activity" => $row['id_activity'],
                    "name_activity" => $row['name_activity'],
                    // "status_activity" => $row['status_activity']
                ));
            }
            // $jsonRespose = json_encode($activities);
            return  $activities;
        }
        

    }


    public function assignActivity($idUser, $id_activity){

        $con = new Conection;

        $query="UPDATE activity SET id_user =$idUser where id_activity = $id_activity";
        $response = mysqli_query($con->Connect(), $query) or die ("Error en la consulta".mysqli_error($con->Connect()));

        
        // $rowsCoutn = mysqli_num_rows($response);

        if($response == 0){
            $message = " Error Actividad Asignada";
            echo json_encode($message);
            mysqli_close($con->Connect());
        }else{
    
            $message = " Actividad Asignada";
         
            mysqli_close($con->Connect());
            
            session_start();
            $_SESSION['alert'] = $message;

            echo json_encode($message);
            }

            
        }


        public function getActivitiesByUser($idUser){

            $con = new Conection;
            $query ="SELECT name_activity, description_activity,id_activity, status_activity, evidence_activity from activity where id_user = $idUser;";


            $response = mysqli_query($con->Connect(),$query) or die ("Error en la Consulta". mysqli_error($con->Connect()));

            $count = mysqli_num_rows($response);

            if($count == 0 ){
                $message = "No se encontraron actividades para el Alumno";
                echo json_encode($message);

                $_SESSION['alert']= $message;
                mysqli_close($con->Connect());  
            }else{
                $arrarActivity = array();
               
             while ($row = mysqli_fetch_array($response)) {

                array_push($arrarActivity, array(
                    "name_activity" => $row['name_activity'],
                    "id_activity" => $row['id_activity'],
                    "description_activity"=> $row['description_activity'],
                    'status_activity'=>$row['status_activity'],
                    "evidence_activity"=>$row['evidence_activity']
               
                ));
            }
            
             return  $arrarActivity;

            mysqli_close($con->Connect());  


           

            }
        }

        function updateEvidence($id_activity, $route){

            $con = new Conection;
            (int)$id_activity;
            $id = intval($id_activity);
            
        
            $query = "UPDATE activity SET evidence_activity = '$route' where id_activity = $id";

            $response = mysqli_query($con->Connect(),$query) or die("Error en consulta" . mysqli_error($con->Connect()));

            if($response==0){
                $message = "No hubo error pero no hay nada que actualizar";

                echo json_encode($message);
                mysqli_close($con->Connect());
            }else{
                $message = "Actividad Enviada, en En espera de aprovación";
                session_start();
                $_SESSION['alert'] = $message;
                mysqli_close($con->Connect());
                echo json_encode($message);
            }
        }


        public function getInfoActivityByIdActivity($idActivity){

            $con = new Conection;

            (int)$idActivity;

            $query ="SELECT a.id_user, u.username, a.name_activity, a.description_activity, a.id_activity, a.status_activity, a.evidence_activity from activity as a, user as u  where u.user_id = a.id_user and id_activity = $idActivity;";


            $response = mysqli_query($con->Connect(),$query) or die ("Error en la Consulta". mysqli_error($con->Connect()));

            $count = mysqli_num_rows($response);

            if($count == 0 ){
                $message = "No se encontraron actividades para el Alumno";
                echo json_encode($message);

                $_SESSION['alert']= $message;
                mysqli_close($con->Connect());  
            }else{
                $arrarActivity = array();
               
             while ($row = mysqli_fetch_array($response)) {

                array_push($arrarActivity, array(
                    "name_activity" => $row['name_activity'],
                    "id_activity" => $row['id_activity'],
                    "description_activity"=> $row['description_activity'],
                    'status_activity'=>$row['status_activity'],
                    "evidence_activity"=>$row['evidence_activity'],
                    "username" => $row['username']
               
                ));
            }
            
           echo json_encode( $arrarActivity);

            mysqli_close($con->Connect());  


           

            }
        }
        public function validateActivity($idActivity,$value) {

            $con = new Conection;
            (int)$idActivity;
            $query = "UPDATE activity set status_activity = '$value' where id_activity = $idActivity";

            $response = mysqli_query($con->Connect(),$query) or die('Error en el consulta'. mysqli_error($con->Connect()));

            if($response == 0){
                $message = "NO hay nada que actualizar";
                echo json_encode($message);
                mysqli_close($con->Connect());
            }else{
                $message = "Actividad Actualizada";
                echo json_encode($message);
                mysqli_close($con->Connect());
                session_start();
                $_SESSION['alert'] = $message;
            }

        }
    }

