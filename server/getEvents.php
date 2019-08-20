<?php
require('conector.php');

session_start();

if (isset($_SESSION['username'])) {
    $con = new DbConnector('localhost','nextu','12345');

    $response['conexion'] = $con->initConnection('php_calendar');
    
    if ($response['conexion'] == 'OK'){
        $user = $_SESSION['username'];
        $resultado = $con->consult(['evento'], ['titulo','fecha_inicio','ind_dia_completo', 'hora_inicio', 'fecha_finalizacion', 'hora_finalizacion'], "WHERE fk_usuario ='".$user."'");
        //$fila = $resultado->fetch_assoc();
        $i=0;
      while ($fila = $resultado->fetch_assoc()) {
        //echo 'Entro ';
        //echo $fila['titulo'];
        $response['eventos'][$i]['titulo']=$fila['titulo'];
        $response['eventos'][$i]['fecha_inicio']=$fila['fecha_inicio'];
        $response['eventos'][$i]['ind_dia_completo']=$fila['ind_dia_completo'];
        $response['eventos'][$i]['hora_inicio']=$fila['hora_inicio'];
        $response['eventos'][$i]['fecha_finalizacion']=$fila['fecha_finalizacion'];
        $response['eventos'][$i]['hora_finalizacion']=$fila['hora_finalizacion'];
        $i++;
      }
      $response['msg'] = "OK";

    }else{
        $response['msg']= "No se pudo conectar a la base de datos";
    }
}else{
    header('Location: '.'../client/index.html');
}

$con->closeConnection();
echo json_encode($response);

 ?>
