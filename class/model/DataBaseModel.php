<?php

abstract class DataBaseModel
{

  private $server = 'localhost';
  private $user = 'root';
  private $password = '';
  private $data_base = 'tuncayb_dash_board';

  private $conn;
  private $error;

  protected $table;
  protected $table_columns;



  protected function query($sql, ...$bind_parameters)
  {
    $this->connect();
    if (count($bind_parameters) === 0) {
      $stmt = $this->conn->prepare($sql);
      if ($stmt === FALSE) {
        $this->error = '<br>' . "SQL error. SQL: $sql ERROR: " . $this->conn->error;
        echo $this->error;
        return FALSE;
      }
    }
    else {
      $parameters_types = "";
      foreach ($bind_parameters as $value) {
        if (gettype($value) === 'string') $parameters_types .= 's';
        else if (gettype($value) === 'integer') $parameters_types .= 'i';
        else if (gettype($value) === 'double') $parameters_types .= 'd';
        else {
          $type = gettype($value);
          echo '<br>' . "Wrong parameter type at query: SQL: $sql TYPE: $type";
        }
      }
      $stmt = $this->conn->prepare($sql);
      if ($stmt === FALSE) {
        $this->error = '<br>' . "SQL error. SQL: $sql ERROR: " . $this->conn->error;
        echo $this->error;
        return FALSE;
      }

      if ($stmt->bind_param($parameters_types, ...$bind_parameters) === FALSE) {
        $this->error = '<br>' . "Statement bind_param ERROR: $stmt->error";
        echo $this->error;
        return FALSE;
      }
    }

    if ($stmt->execute() === FALSE) {
      $this->error = '<br>' . "Statement execution ERROR: $stmt->error";
      echo $this->error;
      return FALSE;
    }

    $result = $stmt->get_result();
    if (empty($stmt->error) === FALSE) {
      $this->error = '<br>' . "Statement getResult ERROR: $stmt->error";
      echo "Yesssdsdkjfvzdkjfvhbzbze";
      echo $this->error;
      return FALSE;
    }
    if ($result === FALSE) return TRUE; //No need for result, only confirm
    return $result;
  }

  protected function queryBlob($sql, $blob, ...$testers) {
    $this->connect();

    $types = "b";

    foreach ($testers as $tester) {
      if (gettype($tester) === 'string') $types .= 's';
      else if (gettype($tester) === 'integer') $types .= 'i';
      else if (gettype($tester) === 'double') $types .= 'd';
      else {
        $this->error = '<br>' . "Wrong type at queryBlob data type: " . gettype($tester);
        echo $this->error;
        return FALSE;
      }
    }

    $stmt = $this->conn->prepare($sql);

    if ($stmt === FALSE) {
      $this->error = '<br>' . "SQL error. SQL: $sql ERROR: " . $this->conn->error;
      echo $this->error;
      return FALSE;
    }

    $null = NULL;
    if ($stmt->bind_param($types, $null, ...$testers) === FALSE) {
      $this->error = '<br>' . "Statement bind_param ERROR: $stmt->error";
      echo $this->error;
      return FALSE;
    }
    if (empty($blob) === FALSE && $stmt->send_long_data(0, $blob) === FALSE) {
      $this->error = '<br>' . "Statement send long data ERROR: $stmt->error";
      echo $this->error;
      return FALSE;
    }
    if ($stmt->execute() === FALSE) {
      $this->error = '<br>' . "Statement execution ERROR: $stmt->error";
      echo $this->error;
      return FALSE;
    }
    return TRUE;
  }

  protected function connect()
  {
    if ($this->data_base === NULL) {
      $this->error = '<br>' . "You have to specify a data base name.";
      echo $this->error;
      return FALSE;
    }
    if ($this->table === NULL) {
      $this->error = '<br>' . "You have to specify a table name.";
      echo $this->error;
      return FALSE;
    }
    if ($this->table_columns === NULL) {
      echo '<br>' . "You have to specify the table columns.";
      return FALSE;
    }

    $this->conn = new mysqli($this->server, $this->user, $this->password, $this->data_base);

    if (empty($this->conn->error) === FALSE) {
      $this->error = '<br>' . "Error on connection. class DBH function connect() ERROR: " . $this->conn->error;
      echo $this->error;
      return FALSE;
    }

    return TRUE;
  }

  protected function init_data_base() {
    $this->createDataBase();

    $this->createTable();
  }

  protected function createDataBase()
  {
    $this->conn = new mysqli($this->server, $this->user, $this->password);

    $sql = "CREATE DATABASE IF NOT EXISTS $this->data_base";

    if ($this->conn->query($sql) === FALSE) {
      $this->error = '<br>' . "Sql error! class DBH function createDataBase() SQL: $sql, ERROR: " . $this->conn->error;
      echo $this->error;
      return FALSE;
    }

    return TRUE;
  }

  protected function resetDataBase()
  {
    $this->conn = new mysqli($this->server, $this->user, $this->password);

    $sql = "DROP DATABASE IF EXISTS $this->data_base";

    if ($this->conn->query($sql) === FALSE) {
      $this->error = '<br>' . "Sql error! class DBH function resetDataBase() SQL: $sql, ERROR: " . $this->conn->error;
      echo $this->error;
      return FALSE;
    }

    $sql = "CREATE DATABASE IF NOT EXISTS $this->data_base";

    if ($this->conn->query($sql) === FALSE) {
      $this->error = '<br>' . "Sql error! class DBH function resetDataBase() SQL: $sql, ERROR: " . $this->conn->error;
      echo $this->error;
      return FALSE;
    }

    return TRUE;
  }

  protected function deleteDataBase()
  {
    $this->conn = new mysqli($this->server, $this->user, $this->password);

    $sql = "DROP DATABASE IF EXISTS $this->data_base";

    if ($this->conn->query($sql) === FALSE) {
      $this->error = '<br>' . "Sql error! class DBH function deleteDataBase() SQL: $sql, ERROR: " . $this->conn->error;
      echo $this->error;
      return FALSE;
    }

    return TRUE;
  }

  protected function createTable()
  {
    $this->connect();

    $sql = "CREATE TABLE IF NOT EXISTS $this->table $this->table_columns";

    if ($this->conn->query($sql) === FALSE) {
      $this->error = '<br>' . "Sql error! class DBH function createTable() SQL: $sql, ERROR: " . $this->conn->error;
      echo $this->error;
      return FALSE;
    }

    return TRUE;
  }

  protected function resetTable()
  {
    $this->connect();

    $sql = "DROP TABLE IF EXISTS $this->table";

    if ($this->conn->query($sql) === FALSE) {
      $this->error = '<br>' . "Sql error! class DBH function resetTable() SQL: $sql, ERROR: " . $this->conn->error;
      echo $this->error;
      return FALSE;
    }

    $sql = "CREATE TABLE IF NOT EXISTS $this->table $this->table_columns";

    if ($this->conn->query($sql) === FALSE) {
      $this->error = '<br>' . "Sql error! class DBH function resetTable() SQL: $sql, ERROR: " . $this->conn->error;
      echo $this->error;
      return FALSE;
    }

    return TRUE;
  }

  protected function deleteTable()
  {
    $this->connect();

    $sql = "DROP TABLE IF EXISTS $this->table";

    if ($this->conn->query($sql) === FALSE) {
      $this->error = '<br>' . "Sql error! class DBH function deleteTable() SQL: $sql, ERROR: " . $this->conn->error;
      echo $this->error;
      return FALSE;
    }

    return TRUE;
  }

}
