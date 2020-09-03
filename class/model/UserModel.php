<?php

class UserModel extends DataBaseModel
{

  public function __construct()
  {
    $this->table = "users";
    $this->table_columns = "(
      id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      username VARCHAR(30) NOT NULL,
      email VARCHAR(60) NOT NULL,
      password CHAR(60) NOT NULL,

      firstname VARCHAR(30),
      lastname VARCHAR(30),
      numero VARCHAR(10),
      adresse TEXT,

      signup_date INT NOT NULL,
      login_date INT,
      confirmed CHAR(5) DEFAULT 'false',

      log_id INT
    )";

    $this->init_data_base();
  }

  public function add_user($username, $email, $password)
  {
    $signup_date = time();

    $sql = "INSERT INTO $this->table (username, email, password, signup_date) VALUES (?,?,?,?)";

    $result = $this->query($sql, $username, $email, $password, $signup_date);

    return $result;
  }

  public function get_user($username_or_email)
  {
    if (strpos($username_or_email, '@') === FALSE) {
      $sql = "SELECT * FROM $this->table WHERE username = ?";

      $result = $this->query($sql, $username_or_email);
    }
    else {
      $sql = "SELECT * FROM $this->table WHERE email = ?";

      $result = $this->query($sql, $username_or_email);
    }

    return $result->fetch_assoc();
  }

  public function get_user_by($column_name, $column_value)
  {
    $sql = "SELECT * FROM $this->table WHERE $column_name = ?";

    $result = $this->query($sql, $column_value);

    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function delete_user($username_or_email)
  {
    if (strpos($username_or_email, '@') === FALSE) {
      $sql = "DELETE FROM $this->table WHERE username = ?";

      $result = $this->query($sql, $username_or_email);
    }
    else {
      $sql = "DELETE FROM $this->table WHERE email = ?";

      $result = $this->query($sql, $username_or_email);
    }

    return $result;
  }

  public function set_user_column($username, $column_name, $new_value) {
    $sql = "UPDATE $this->table SET $column_name = ? WHERE username = ?";

    $result = $this->query($sql, $new_value, $username);

    return $result;
  }
}
