<?php

class ingredient {
    private static $connection;

    public function __construct($connection) {
        self::$connection = $connection;
    }
  
    public static function selectingredient($dish_id) {
      $data = [];
      $data2 = [];

      $sql = "SELECT *  FROM ingredients WHERE dish_id = $dish_id";
      $result = mysqli_query(self::$connection, $sql);


      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
      $artikel_id = $row['artikel_id'];
      $sql2 = "SELECT name, description, price, unit, content, calorie, picture  FROM artikel WHERE id LIKE '%$artikel_id%'"; 
      $result2 = mysqli_query(self::$connection, $sql2); 
      $data2 =mysqli_fetch_array($result2, MYSQLI_ASSOC);
      $data[] = array_merge($row,$data2);
      }

      return($data);

    }







}