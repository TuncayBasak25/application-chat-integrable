<?php

class UserModel extends DataBaseModel
{

  public function __construct()
  {
    $this->table = "users";
    $this->table_columns = "(
      id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

      username VARCHAR(10) NOT NULL,

      login_date INT,
      last_update INT,
      login_id TEXT
    )";

    $this->init_data_base();
  }

  public function reset()
  {
    $this->resetTable();
  }

  public function add_user($username)
  {
    $login_date = time();
    $login_id = session_id();

    $sql = "INSERT INTO $this->table (username, login_date, login_id) VALUES (?,?,?)";

    $result = $this->query($sql, $username, $login_date, $login_id);

    return $result;
  }

  public function get_user($username)
  {
    $sql = "SELECT * FROM $this->table WHERE username = ?";

    $result = $this->query($sql, $username);

    return $result->fetch_assoc();
  }

  public function get_user_by($column_name, $column_value)
  {
    $sql = "SELECT * FROM $this->table WHERE $column_name = ?";

    $result = $this->query($sql, $column_value);

    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function delete_user($username)
  {
    $sql = "DELETE FROM $this->table WHERE username = ?";

    $result = $this->query($sql, $username);

    return $result;
  }

  public function set_user_column($username, $column_name, $new_value) {
    $sql = "UPDATE $this->table SET $column_name = ? WHERE username = ?";

    $result = $this->query($sql, $new_value, $username);

    return $result;
  }
}
