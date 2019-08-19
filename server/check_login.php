<?php

require('conector.php');

$con = new DbConnector('localhost','nextu','12345');

$response['conexion'] = $con->initConnection('php_calendar');

if ($response['conexion'] == 'OK'){
    $resultado_consulta = $con->consult(['usuario'],
    ['nombre_usuario', 'pass'], 'WHERE nombre_usuario="'.$_POST['username'].'"');

    if ($resultado_consulta->num_rows != 0) {
      $fila = $resultado_consulta->fetch_assoc();
      if (password_verify($_POST['password'], $fila['pass'])) {
        $response['msg'] = 'OK';
        session_start();
        $_SESSION['username']=$fila['nombre_usuario'];
      }else {
        $response['msg'] = 'Contraseña incorrecta';
        //$response['acceso'] = 'rechazado';
      }
    }else{
      $response['msg'] = 'Email incorrecto';
      //$response['acceso'] = 'rechazado';
    }
}else{
    $response['msg']= "No se pudo conectar a la base de datos";
}

$con->closeConnection();

echo json_encode($response);



 ?>
