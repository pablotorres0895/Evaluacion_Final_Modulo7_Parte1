<?php
require('conector.php');

session_start();

if (isset($_SESSION['username'])) {
    $con = new DbConnector('localhost','nextu','12345');

    $response['conexion'] = $con->initConnection('php_calendar');
    
    if ($response['conexion'] == 'OK'){
      $consulta = "Select * from evento where fk_usuario = '".$_SESSION['username']."'";
      $result = $con->executeQuery($consulta);
      while($fila = mysqli_fetch_array($result)){
        if(empty($Eventos)){
          $eventos="[".json_encode(array("id"=> $fila['id_evento'], "title"=> $fila['titulo'], "start"=> $fila['fecha_inicio']." ". $fila['hora_inicio'], "allDay"=> $fila['ind_dia_completo'], "end"=> $fila['fecha_finalizacion']." ".$fila['hora_finalizacion']));
        }else{
          $eventos=$eventos.",".json_encode(array("id"=> $fila['id_evento'], "title"=> $fila['titulo'], "start"=> $fila['fecha_inicio']." ". $fila['hora_inicio'], "allDay"=> $fila['ind_dia_completo'], "end"=> $fila['fecha_finalizacion']." ".$fila['hora_finalizacion']));
        }
      }
      if(!empty($eventos)){
        $eventos=$eventos."]";
        $response['eventos']  = $eventos;
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
