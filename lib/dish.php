<?php

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

  public function calccalories($dish_id){
    $totcalorie =0;
    $data = ingredient::selectingredient($dish_id);

    $arrlength = count($data);
    for($x = 0; $x < $arrlength; $x++) {
      $artikel = $data[$x];
      $amount = $artikel['amount'];
      $calorie = $artikel['calorie'];
      $totcalorie = $amount/100*$calorie+$totcalorie;
    }

    return($totcalorie);
  }

  public function calcprice($dish_id){
    $totprice =0;
    $data = ingredient::selectingredient($dish_id);

    $arrlength = count($data);
    for($x = 0; $x < $arrlength;$x++ ) {
      $artikel = $data[$x];
      $amount = $artikel['amount'];
      $content = $artikel['content'];
      $price = $artikel['price'];
      $totprice = ceil($amount/$content)*$price+ $totprice ;
    }

    return($totprice);
    
  }

  public function selectrating(){

  }

  public function selectsteps(){
    
  }

  public function selectremarks(){
    
  }

}

?>