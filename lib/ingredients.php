<?php

class ingredient {
    private $connection;
    private $artikel;

    public function __construct($connection) {
      $this->connection = $connection;
      $this->artikel = new artikel($connection);
    }

    public function fetchArtikel($artikel_id){
      $data = $this->artikel->selectArtikel($artikel_id);
      return($data);
    }
  
    public function selectIngredient($dish_id) {
      $data = [];
      $data2 = [];

      $sql = "SELECT *  FROM ingredients WHERE dish_id = $dish_id";
      $result = mysqli_query($this->connection, $sql);

      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
      $artikel_id = $row['artikel_id'];
      $data2 = $this->fetchArtikel($artikel_id);
      $data[] = array_merge($row,$data2);
      }

      return($data);

    }







}