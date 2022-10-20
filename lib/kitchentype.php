<?php

class kitchentype {

    private static $connection;

    public function __construct($connection) {
        self::$connection = $connection;
    }
  
    public function selectkitchentype($kitchentype_id) {

      $sql = "SELECT *  FROM kitchen_type WHERE id = $kitchentype_id";
        
      $result = mysqli_query(self::$connection, $sql);
      $data =mysqli_fetch_array($result, MYSQLI_ASSOC);
      
      return($data);

    }



}