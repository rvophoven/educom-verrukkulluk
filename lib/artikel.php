<?php

class artikel {

    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }
  
    public function allArtikel($artikel_id) {

      $sql = "SELECT *  FROM artikel WHERE id = $artikel_id";
        
      $result = mysqli_query($this->connection, $sql);
      $data =mysqli_fetch_array($result, MYSQLI_ASSOC);
      
      return($data);

    }



}