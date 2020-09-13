<?php

class MessageModel extends DataBaseModel
{

  public function __construct()
  {
    $this->table = "message";
    $this->table_columns = "(
      id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

      source VARCHAR(10) NOT NULL,
      destination VARCHAR(30) DEFAULT 'global',

      message VARCHAR(300) NOT NULL,

      send_date INT NOT NULL
    )";

    $this->init_data_base();
  }

  public function reset()
  {
    $this->resetTable();
  }

  public function new_message($source, $message)
  {
    $send_date = time();

    $sql = "INSERT INTO $this->table (source, message, send_date) VALUES (?,?,?)";

    $result = $this->query($sql, $source, $message, $send_date);

    return $result;
  }

  public function get_last_message()
  {
    $sql = "SELECT * FROM $this->table ORDER BY id DESC LIMIT 1";

    $result = $this->query($sql);

    return $result->fetch_assoc();
  }

  public function get_all_message_after($id)
  {
    $sql = "SELECT * FROM $this->table WHERE id > ?";

    $result = $this->query($sql, $id);

    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function get_all_last_message($limit = 30) //Renvoi les dernier message enregistrée
  {
    $sql = "SELECT * FROM $this->table ORDER BY id DESC LIMIT ?";

    $result = $this->query($sql, $limit)->fetch_all(MYSQLI_ASSOC);

    return array_reverse($result);
  }

  public function get_user_all_message($source) //Renvoie un tableau associatif de tous les produit possedé par un utilisateur
  {
    $sql = "SELECT * FROM $this->table WHERE source = ?";

    $result = $this->query($sql, $source);

    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function get_all_message_since($date) //Renvoie un tableau associatif de tous les produit possedé par un utilisateur
  {
    $sql = "SELECT * FROM $this->table WHERE send_date > ?";

    $result = $this->query($sql, $date);

    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function delete_user_all_message($source) //Efface un produit possedé par un utilisateur
  {
    $sql = "DELETE FROM $this->table WHERE source = ?";

    $result = $this->query($sql, $source);

    return $result;
  }

  public function delete_all_message_before($date) //Efface un produit possedé par un utilisateur
  {
    $sql = "DELETE FROM $this->table WHERE send_date < ?";

    $result = $this->query($sql, $date);

    return $result;
  }
}
