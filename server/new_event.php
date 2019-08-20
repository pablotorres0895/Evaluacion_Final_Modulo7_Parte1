<?php
require('conector.php');

$con = new DbConnector('localhost','nextu','12345');

$response['conexion'] = $con->initConnection('php_calendar');

if ($response['conexion'] == 'OK'){
    $data['fk_usuario'] = "'".'user1'."'";
    $data['titulo'] = "'".$_POST['titulo']."'";
    $data['fecha_inicio'] = "'".$_POST['start_date']."'";
    $data['ind_dia_completo'] = "'".$_POST['allDay']."'";
    if ($_POST['allDay'] == 'false'){
        $data['hora_inicio'] = "'".$_POST['start_hour']."'";
        $data['fecha_finalizacion'] = "'".$_POST['end_date']."'";
        $data['hora_finalizacion'] = "'".$_POST['end_hour']."'";
        $consulta = "INSERT INTO evento (fk_usuario, 
        titulo, 
        fecha_inicio, 
        ind_dia_completo, 
        hora_inicio,
        fecha_finalizacion,
        hora_finalizacion)
        VALUES (".$data['fk_usuario'].
        ",".$data['titulo'].
        ",".$data['fecha_inicio'].
        ",".$data['ind_dia_completo'].
        ",".$data['hora_inicio'].
        ",".$data['fecha_finalizacion'].
        ",".$data['hora_finalizacion'].")";
    }else{
        $consulta = "INSERT INTO evento (fk_usuario, titulo, fecha_inicio, ind_dia_completo)
        VALUES (".$data['fk_usuario'].
        ",".$data['titulo'].
        ",".$data['fecha_inicio'].
        ",".$data['ind_dia_completo'].")";
        

    }
    if ($con->executeQuery($consulta) === true){

        $response['msg'] = "OK";
    } else {
        $response['msg'] = "ERROR";
    }
      
}else{
    $response['msg']= "No se pudo conectar a la base de datos";

}
echo json_encode($response);  
$con->closeConnection(); 

 ?>
