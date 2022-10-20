<?php

class user {

    private static $connection;

    public function __construct($connection) {
        self::$connection = $connection;
    }
  
    public static function selectUser($user_id) {

      $sql = "SELECT *  FROM users WHERE id = $user_id";
        
      $result = mysqli_query(self::$connection, $sql);
      $data =mysqli_fetch_array($result, MYSQLI_ASSOC);    

      return($data);

    }


}