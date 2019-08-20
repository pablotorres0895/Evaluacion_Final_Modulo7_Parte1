<?php
 require('conector.php');

 $con = new DbConnector('localhost','nextu','12345');
 
 $response['conexion'] = $con->initConnection('php_calendar');
 
 if ($response['conexion'] == "OK"){
    
    $data['fecha_inicio'] = "'".$_POST['start_date']."'";
       
    $data['hora_inicio'] = "'".$_POST['start_hour']."'";
    $data['fecha_finalizacion'] = "'".$_POST['end_date']."'";
    $data['hora_finalizacion'] = "'".$_POST['end_hour']."'";
    
    if ($con->updateRecord('evento', $data, 'id_evento = '.$_POST['id'])){
        $response['msg'] = "OK";
    }else{
        $response['msg'] = "ERROR AL ACTUALIZAR";
    }
}else{
    $response['msg'] = "ERROR DE CONEXION";
}
echo json_encode($response);


?>
