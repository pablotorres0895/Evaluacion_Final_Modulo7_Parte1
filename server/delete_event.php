<?php


require('conector.php');

$con = new DbConnector('localhost','nextu','12345');

$response['conexion'] = $con->initConnection('php_calendar');

if ($response['conexion'] == "OK"){
    $id = $_POST['id'];
    if ($con->deleteRecord('evento', 'id_evento = '.$id)){
        $response['msg'] = "OK";
    }else{
        $response['msg'] = "ERROR ELIMINACION";
    }
}else{
    $response['msg'] = "ERROR CONEXION";
}
echo json_encode($response);
?>
