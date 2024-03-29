<?php namespace DataBase;
require_once 'Conection.php';
// ini_set('error_reporting', E_STRICT);

$conexion= new Conection;
$conected =$conexion->Connect();
$_POST = json_decode(file_get_contents('php://input'), true);

$username =$_POST['username'];
$password= $_POST['password'];
/* create a prepared statement */
// "SELECT * FROM alumno WHERE nombre like ?";
if ($stmt = $conected->prepare("SELECT * FROM user WHERE username=? and password=?")) {

    /* bind parameters for markers */
    $stmt->bind_param("ss", $username,$password);

    /* execute query */
      $stmt->execute();
      $stmt->store_result();
    /* bind result variables */
    $stmt->bind_result($user_id, $name, $paternal_name, $maternal_name, $password, $user_type_id, $email,$username,$id_team);
    // var_dump($stmt->affected_rows);
   
    /* fetch value */
    $stmt->fetch();
    // var_dump($name, $paternal_name);
    if($name != null && $password !=null) {

        $response = array(
            'status' => 'authorized',
            'user_id'=> $user_id,
            'name'=>$name,
            'paternal_name'=> $paternal_name,
            'maternal_name'=> $maternal_name,
            'type' => $user_type_id,
            'email'=> $email,
            'username'=>$username,
            'id_team'=>$id_team

        );
        // INICIO EN EL MANEJO DE SESIONES
        session_start();
        $_SESSION['user_type_id']  = $user_type_id;
        $_SESSION['username']= $username;
        $_SESSION['name']  = $name;
        $_SESSION['paternal_name']  = $paternal_name;
        $_SESSION['maternal_name']  = $maternal_name;
        $_SESSION['email']  = $email;
        $_SESSION['id_team']  = $id_team;
        $_SESSION['user_id']  = $user_id;
        
        
        echo json_encode($response); 
        
        // var_dump($response);
        // var_dump($response);
        
    }else{
        $response = array('status' => 'Not authorized', 'type' => $user_type_id);

        echo json_encode($response); 
    }
  

    /* close statement */
    $stmt->close();
}

/* close connection */
$conected->close();