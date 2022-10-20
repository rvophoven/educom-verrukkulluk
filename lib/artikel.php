<?php

class artikel {

    private static $connection;

    public function __construct($connection) {
        self::$connection = $connection;
    }
  
    public function selectArtikel($artikel_id) {

      $sql = "SELECT *  FROM artikel WHERE id = $artikel_id";
        
      $result = mysqli_query(self::$connection, $sql);
      $data =mysqli_fetch_array($result, MYSQLI_ASSOC);
      
      return($data);

    }



}