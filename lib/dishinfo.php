<?php

class dishinfo {

    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }
  

    public function selectdishinfo($dish_id,$record_type) {

      $sql = "SELECT *  FROM dish_info WHERE dish_id = $dish_id AND record_type LIKE '%$record_type%'";
        
      $data = [];
      $result = mysqli_query($this->connection, $sql);

      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $data[] = $row;   
      }
      
      return($data);

    }


    public function addfavorite($dish_id,$user_id){
      $sql = "DELETE FROM dish_info WHERE record_type = 'f' AND dish_id = $dish_id AND users_id = $user_id";
      mysqli_query($this->connection, $sql);

      $sql = "INSERT INTO dish_info (record_type, dish_id, users_id) VALUES ('f',$dish_id,$user_id)";
      mysqli_query($this->connection, $sql);


    }

    public function deletefavorite($dish_id,$user_id){
      $sql = "DELETE FROM dish_info WHERE record_type = 'f' AND dish_id = $dish_id AND users_id = $user_id";
      mysqli_query($this->connection, $sql);
    }

    


      

}