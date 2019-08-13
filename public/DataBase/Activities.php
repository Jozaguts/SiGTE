<?php namespace DataBase;

require_once 'Conection.php';
$_POST = json_decode(file_get_contents('php://input'), true);


class Activities {

    public function getActivitiesByProject($idProject){
    

        $connection = new Conection;
        
        // consulta solo para traer los alumnos que no has sido asignados y al maestro TODOS ESTAN EN LA TABLA USER
        $query="SELECT id_activity, name_activity, status_activity from activity where  id_project = $idProject;";
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
        
        // consulta solo para traer los alumnos que no has sido asignados y al maestro TODOS ESTAN EN LA TABLA USER
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

}
