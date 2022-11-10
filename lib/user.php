<?php

class user {

    private $connection;

    public function __construct($connection) {
      $this->connection = $connection;
    }
  
    public function selectUser($user_id) {

      $sql = "SELECT *  FROM users WHERE id = $user_id";
        
      $result = mysqli_query($this->connection, $sql);
      $data =mysqli_fetch_array($result, MYSQLI_ASSOC);    

      return($data);

    }

    public function loginUser($email, $password) {
      // passwords are not hashed and not secure. 
      $sql = "SELECT id, user_name FROM users WHERE  email = '$email' AND password = '$password'";
      $result = mysqli_query($this->connection, $sql);
      $data =mysqli_fetch_array($result, MYSQLI_ASSOC);  
      
      if (mysqli_num_rows($result) == 0){
        $data["id"] = 0;
        $data["user_name"] = "Error";
      }

      return($data);

    }





}