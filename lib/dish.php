<?php
require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/kitchentype.php");
require_once("lib/dishinfo.php");
require_once("lib/ingredients.php");
require_once("lib/dish.php");

$db = new database();
$user = new user($db->getConnection());
$user_id = 2;
$artikel = new artikel($db->getConnection());
$artikel_id = 2;
$kitchentype = new kitchentype($db->getConnection());
$kitchen_id = 1;
$type_id = 3;
$dishinfo = new dishinfo($db->getConnection());
$dish_id = 2;
$record_type = "o";
$ingredient = new ingredient($db->getConnection());
$dish = new dish($db->getConnection());

class dish{
  private static $connection;

  public function __construct($connection) {
      self::$connection = $connection;
  }

  public function selectdish($dish_id){
      $sql = "SELECT *  FROM dish WHERE id = $dish_id";
      $result = mysqli_query(self::$connection, $sql);
      $data =mysqli_fetch_array($result, MYSQLI_ASSOC);
      return($data);
  }

  public function selectuser($dish_id){
      //get user id dish
      $data = self::selectdish($dish_id);
      //get user name
      $user_id = $data['users_id'];
      $data = user::selectUser($user_id);
      $data = $data['user_name'];
      return($data);

  }

  public function selectingredient($dish_id){
    $data = ingredient::selectingredient($dish_id);
    return($data);
     
  }

  public function calcCalories(){
    
    
  }

  public function calcPrice(){
    
  }

  public function selectrating(){

  }

  public function selectsteps(){
    
  }

  public function selectremarks(){
    
  }

}

?>