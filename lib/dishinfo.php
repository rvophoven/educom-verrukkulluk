<?php

class dishinfo {

    private $connection;

    public function __construct($connection) {
      $this->connection = $connection;
    }
  

    public function selectDishinfo($dish_id,$record_type) {

      $sql = "SELECT *  FROM dish_info WHERE dish_id = $dish_id AND record_type LIKE '%$record_type%'";
        
      $data = [];
      $result = mysqli_query($this->connection, $sql);

      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $data[] = $row;   
      }
      
      return($data);

    }

    public function selectLikes($user_id) {// get likes from user

      $sql = "SELECT dish_id  FROM dish_info WHERE users_id = $user_id AND record_type LIKE 'f'";
        
      $data = [];
      $result = mysqli_query($this->connection, $sql);

      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $data[] = $row;   
      }
      
      return($data);

    }

    public function addFavorite($dish_id,$user_id){
      $this->deletefavorite($dish_id,$user_id);
      $sql = "INSERT INTO dish_info (record_type, dish_id, users_id) VALUES ('f',$dish_id,$user_id)";
      mysqli_query($this->connection, $sql);
    }

    public function deleteFavorite($dish_id,$user_id){
      $sql = "DELETE FROM dish_info WHERE record_type = 'f' AND dish_id = $dish_id AND users_id = $user_id";
      mysqli_query($this->connection, $sql);
    }

    public function addStar($dish_id,$stars){
      $sql = "INSERT INTO dish_info (record_type, dish_id, numberfield) VALUES ('w',$dish_id,$stars)";
      mysqli_query($this->connection, $sql);
    }

    


      

}