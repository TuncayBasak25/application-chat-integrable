<?php

class UserProductModel extends DataBaseModel
{

  public function __construct()
  {
    $this->table = "user_product";
    $this->table_columns = "(
      id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

      owner VARCHAR(30) NOT NULL,

      name VARCHAR(30) NOT NULL,

      purchase_date INT NOT NULL,

      warrent_date INT
    )";

    $this->init_data_base();
  }

  public function add_product($owner, $name, $warrent_date = 1000) //Rajoute un nouveau produit avec un temps de garenti de 15 minute par default
  {
    $purchase_date = time();
    $warrent_date += $purchase_date;

    $sql = "INSERT INTO $this->table (owner, name, purchase_date, warrent_date) VALUES (?,?,?,?)";

    $result = $this->query($sql, $owner, $name, $purchase_date, $warrent_date);

    return $result;
  }

  public function get_user_products($owner) //Renvoie un tableau associatif de tous les produit possedé par un utilisateur
  {
    $sql = "SELECT * FROM $this->table WHERE owner = ?";

    $result = $this->query($sql, $owner);

    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function get_user_warrently_products($owner) //Renvoie tous les produit encore sous garanti
  {
    $date = time();

    $sql = "SELECT * FROM $this->table WHERE $owner = ? AND warrent_date > ?";

    $result = $this->query($sql, $owner, $date);

    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function get_user_unwarrently_products($owner) //Renvoie tous les produit qui ne sont plus sous garanti
  {
    $date = time();

    $sql = "SELECT * FROM $this->table WHERE $owner = ? AND warrent_date < ?";

    $result = $this->query($sql, $owner, $date);

    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function delete_user_product($owner, $name) //Efface un produit possedé par un utilisateur
  {
    $sql = "DELETE FROM $this->table WHERE username = ? AND name = ?";

    $result = $this->query($sql, $owner, $name);

    return $result;
  }
}
