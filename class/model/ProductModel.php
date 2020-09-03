<?php

class UserProductModel extends DataBaseModel
{

  public function __construct()
  {
    $this->table = "user_product";
    $this->table_columns = "(
      id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

      name VARCHAR(30) NOT NULL,

      price INT,

      description TEXT,

      warrent_time INT,

      photo MEDIUMBLOB,
      is_default_photo CHAR(5) DEFAULT 'true'
    )";

    $this->init_data_base();
  }

  public function add_product($name, $price, $description, $warrent_time = 1000)
  {
    $sql = "INSERT INTO $this->table (name, price, description, warrent_time) VALUES (?,?,?,?)";

    $result = $this->query($sql, $name, $price, $description, $warrent_time);

    return $result;
  }

  public function get_product($name) //Renvoie un tableau associatif de tous les produit possedé par un utilisateur
  {
    $sql = "SELECT (id, name, price, description, warrent_time, is_default_photo) FROM $this->table WHERE name = ?";

    $result = $this->query($sql, $name);

    return $result->fetch_assoc();
  }

  public function get_product_photo($name)
  {
    $sql = "SELECT photo FROM $this->table WHERE name = ?";

    $result = $this->query($sql, $name);

    return $result->fetch_assoc();
  }

  public function set_product_photo($name, $photo)
  {
    $sql = "UPDATE $this->table SET photo = ? WHERE name = ?";

    $result = $this->queryBlob($sql, $photo, $name);

    if ($result !== FALSE) {
      $sql = "UPDATE $this->table SET is_default_photo = ? WHERE name = ?";

      $result = $this->query($sql, 'false', $name);
    }
    return $result;
  }

  public function delete_product($name)
  {
    $sql = "DELETE FROM $this->table WHERE name = ?";

    $result = $this->query($sql, $name);

    return $result;
  }
}
