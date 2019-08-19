<?php
require('conector.php');

$con = new DbConnector('localhost','nextu','12345');

$response['conexion'] = $con->initConnection('php_calendar');

if ($response['conexion'] == 'OK'){
    session_start();
    $user = $_SESSION['username'];

    $data['fk_usuario'] = "'".$user."'";
    $data['titulo'] = "'".$_POST['titulo']."'";
    $data['fecha_inicio'] = "'".$_POST['start_date']."'";
    $data['ind_dia_completo'] = "'".$_POST['allDay']."'";
    if ($_POST['allDay'] == 'true'){
        $data['hora_inicio'] = "'".'00:00:00'."'";
        $data['fecha_finalizacion'] = "'".'00:00:00'."'";
        $data['hora_finalizacion'] = "'".'00:00:00'."'";
    }else{
        $data['hora_inicio'] = "'".$_POST['start_hour']."'";
        $data['fecha_finalizacion'] = "'".$_POST['end_date']."'";
        $data['hora_finalizacion'] = "'".$_POST['end_hour']."'";
    }
    if($con->insertData('evento', $data)){
        $response['msg'] = "OK";
    }else{
        $response['msg'] = "Error al insertar";
    }
}else{
    $response['msg']= "No se pudo conectar a la base de datos";
}

$con->closeConnection();
echo json_encode($response);


 ?>
