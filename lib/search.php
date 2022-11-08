<?php
/* code is not in use anymore but i wil leave it*/
class search{

  private $connection;

  public function __construct($connection) {
    $this->connection = $connection;
  }

  public function getSearch($text=0) {

    $sql = "SELECT id FROM dish WHERE title LIKE '%$text%' OR short_description LIKE '%$text%'";
      
    $data = [];
    $result = mysqli_query($this->connection, $sql);

    if (mysqli_num_rows($result) > 0){

      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $data[] = $row["id"];   
       }

    }else{
      $data = "No results found";
    }
    
    return($data);

  }


}
?>