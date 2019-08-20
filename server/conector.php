<?php 
class DbConnector
{
    private $host;
    private $user;
    private $password;
    private $connection;

    function __construct($host, $user, $password){
      $this->host = $host;
      $this->user = $user;
      $this->password = $password;
    }

    function initConnection($dbName){
      $this->connection = new mysqli($this->host, $this->user, $this->password, $dbName);
      if ($this->connection->connect_error) {
        return "Error:" . $this->connection->connect_error;
      }else {
        return "OK";
      }
    }

    function executeQuery($query){
        return $this->connection->query($query);
    }
  
    function closeConnection(){
        $this->connection->close();
    }
    function insertData($tabla, $data){
      $sql = 'INSERT INTO '.$tabla.' (';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= $key;
        if ($i<count($data)) {
          $sql .= ', ';
        }else $sql .= ')';
        $i++;
      }
      $sql .= ' VALUES (';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= $value;
        if ($i<count($data)) {
          $sql .= ', ';
        }else $sql .= ');';
        $i++;
      }
      echo $sql;
      return $this->executeQuery($sql);

    }

    function consult($tablas, $campos, $condicion = ""){
      $sql = "SELECT ";
      $temp = array_keys($campos);
      $ultima_key = end($temp);
      
      foreach ($campos as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .=" FROM ";
      }
      $temp = array_keys($tablas);
      $ultima_key = end($temp);
      foreach ($tablas as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .= " ";
      }
      
      if ($condicion == "") {
        $sql .= ";";
      }else {
        $sql .= $condicion.";";
      }
      return $this->executeQuery($sql);
    }
    
    function deleteRecord($tabla, $condicion){
      $sql = "DELETE FROM ".$tabla." WHERE ".$condicion.";";
      return $this->executeQuery($sql);
    }

    function updateRecord($tabla, $data, $condicion){
      $sql = 'UPDATE '.$tabla.' SET ';
      $i=1;
      foreach ($data as $key => $value) {
        $sql .= $key.'='.$value;
        if ($i<sizeof($data)) {
          $sql .= ', ';
        }else $sql .= ' WHERE '.$condicion.';';
        $i++;
      }
      //echo $sql;
      return $this->executeQuery($sql);
    }
}

?>