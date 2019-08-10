<?php namespace DataBase;


require 'Conection.php';


$conexion= new Conection;
$conected =$conexion->Connect();
$_POST = json_decode(file_get_contents('php://input'), true);

$name =$_POST['name'];
$paternal_name =$_POST['paternal_name'];
$maternal_name =$_POST['maternal_name'];
$password =$_POST['password'];
// $user_type_id = null;
$email =$_POST['email'];
$username =$_POST['username'];


/* create a prepared statement */
$query="INSERT into `user`(name,paternal_name,maternal_name,password,email,username
) VALUES (?,?,?,?,?,?)";


if (!$stmt = $conected->prepare($query)) {
    $response = array('status' => 'Error', 'type' => $stmt->errno);
    echo json_encode($response);
    }

if(! $stmt->bind_param("ssssss",$name,$paternal_name,$maternal_name,$password,$email,$username)){ 

    $response = array('status' => 'Error', 'type' => $stmt->errno);
    echo json_encode($response);
}
if(!$stmt->execute()){ 
    
    $response = array('status' => 'Error', 'type' => $stmt->errno);
    echo json_encode($response);
}else{
    $response = array('status' => 'Success', 'type' => 'Alumno Registrado');
    session_start();
    $_SESSION['alert'] =  'Alumno Registrado';
    echo json_encode($response);
}

