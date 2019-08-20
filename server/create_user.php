<?php

function create_user($con, $fec, $nombreCompleto, $nombreUsuario, $pass){
    $data['fecha_nacimiento'] = "'".$fec."'";
    $data['nombre_completo'] = "'".$nombreCompleto."'";
    $data['nombre_usuario'] = "'".$nombreUsuario."'";
    $data['pass']="'".password_hash($pass, PASSWORD_DEFAULT)."'";
    //$response['res'] = $con->insertData('usuario', $data);
    if($con->insertData('usuario', $data)){
        $response['creation_res'] = "Inserción exitosa";
    }else{
        $response['creation_res'] = "Inserción erronea";
    }
}
require('conector.php');

$con = new DbConnector('localhost','nextu','12345');

$response['conexion'] = $con->initConnection('php_calendar');

if ($response['conexion'] == 'OK'){
    create_user($con, "20/08/1995", "jose pablo", "user1", '12345');
    create_user($con, "19/07/1994", "jose peralta", "user2", '12345');
    create_user($con, "18/06/1993", "pablo torres", "user3", '12345');
}else{
    $response['msg']= "No se pudo conectar a la base de datos";
}

$con->closeConnection();

echo json_encode($response);
 ?>
