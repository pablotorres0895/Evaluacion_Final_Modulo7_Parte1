<?php
require('conector.php');

session_start();

if (isset($_SESSION['username'])) {
    $con = new DbConnector('localhost','nextu','12345');

    $response['conexion'] = $con->initConnection('php_calendar');
    
    if ($response['conexion'] == 'OK'){
        $resultado = $con->consult(['evento'], ['id_evento', 
                                                'titulo', 
                                                'fecha_inicio', 
                                                'hora_inicio',
                                                'fecha_finalizacion',
                                                'hora_finalizacion',
                                                'ind_dia_completo'], "WHERE fk_usuario ='".$_SESSION['username']."'");
        
        $i=0;
        
        while($fila = $resultado->fetch_assoc()){
            $response['eventos'][$i]['id']=$fila['id_evento'];
            $response['eventos'][$i]['title']=$fila['titulo'];
            $response['eventos'][$i]['start']=$fila['fecha_inicio']." ".$fila['hora_inicio'];
            $response['eventos'][$i]['allDay']=$fila['ind_dia_completo'];
            $response['eventos'][$i]['end']=$fila['fecha_finalizacion']." ".$fila['hora_finalizacion'];
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
