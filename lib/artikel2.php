<?php

class artikel {

    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }
  
    public function allArtikel($id) {

      $sql = "SELECT *  FROM artikel WHERE id = $id";
        
      $result = mysqli_query($this->connection, $sql);
      $data =mysqli_fetch_array($result, MYSQLI_ASSOC);
      

      return($data);

    }

    public function searchArtikel(){
      $id = 'Kaas';
      $sql = "SELECT *  FROM artikel WHERE name LIKE '%$id%' ";
        
      $result = mysqli_query($this->connection, $sql);
      $data =mysqli_fetch_array($result, MYSQLI_ASSOC);
      

      return($data);

    }


}