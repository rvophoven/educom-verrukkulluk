<?php

class kitchentype {

    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }
  
    public function selectkitchentype($kitchentype_id) {

      $sql = "SELECT *  FROM kitchen_type WHERE id = $kitchentype_id";
        
      $result = mysqli_query($this->connection, $sql);
      $data =mysqli_fetch_array($result, MYSQLI_ASSOC);
      
      return($data);

    }



}