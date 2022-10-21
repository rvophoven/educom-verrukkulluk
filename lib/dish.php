<?php

class dish{
  //set privata variables
  private $connection;
  private $ingredient;
  private $users;
  private $dishinfo;
  private $kitchentype;
  //get new classes......................................................
  public function __construct($connection) {
    $this->connection = $connection;
    $this->ingredient = new ingredient($connection);
    $this->users = new user($connection);
    $this->dishinfo = new dishinfo($connection);
    $this->kitchentype = new kitchentype($connection);
  }
  //get functions classses...............................................
  public function fetchIngredient($artikel_id){
    $data = $this->ingredient->selectIngredient($artikel_id);// can also use this instead of $this->fetchIngredient.
    return($data);
  }

  public function fetchUser($artikel_id){
    $data = $this->users->selectUser($artikel_id);
    $data = $data['user_name'];
    return($data);
  }

  public function fetchDishinfo($artikel_id,$record_type){
    $data = $this->dishinfo->selectDishinfo($artikel_id,$record_type);
    return($data);
  }

  public function fetchKitchentype($artikel_id,$record_type){
    $data = $this->kitchentype->selectKitchentype($artikel_id,$record_type);
    $data = $data['description'];
    return($data);
  }

  public function fetchDish($dish_id){
      $sql = "SELECT *  FROM dish WHERE id = $dish_id";
      $result = mysqli_query($this->connection, $sql);
      $data =mysqli_fetch_array($result, MYSQLI_ASSOC);
      return($data);
  }

  public function selectUser($dish_id){
      //get user id dish
      $data = $this->fetchDish($dish_id);
      //get user name
      $user_id = $data['users_id'];
      $data = $this->fetchUser($user_id);// can also use $data['users_id']
      return($data);
  }

  public function selectIngredient($dish_id){
    $data = $this->fetchIngredient($dish_id);
    return($data);   
  }

  public function addStars($dish_id,$stars){
    $this->dishinfo->addStar($dish_id,$stars);
  }
// dish functions/methods.................................................
  //calc calories dish from database
  public function calcCalories($dish_id){
    $totcalorie =0;
    $data = $this->fetchIngredient($dish_id);

    foreach($data as $value){
      $amount = $value['amount'];
      $calorie = $value['calorie'];
      $totcalorie += $amount/100*$calorie;
    }
    /*old methode code
    for($x = 0; $x < count($data); $x++) {
      $amount = $data[$x]['amount'];
      $calorie = $data[$x]['calorie'];
      $totcalorie += $amount/100*$calorie;
    }
    */
    return($totcalorie);
  }
  //calc price dish calculation from database
  public function calcPrice($dish_id){
    $totprice =0;
    $data = $this->fetchIngredient($dish_id);
    foreach($data as $value){
      $amount = $value['amount'];
      $content = $value['content'];
      $price = $value['price'];
      $totprice += ceil($amount/$content)*$price ;
    }
    return($totprice);
  }
  //get avarage dish rating from database
  public function selectRating($dish_id){
    $data = [];
    $rating = 0;
    $data = $this->fetchDishinfo($dish_id,"w");

    foreach($data as $value){
      $rating += $value['numberfield'];
    }
    $rating = $rating/count($data);
    return($rating);
  }
  //get dish steps from database
  public function selectSteps($dish_id){
    $data = [];
    $data2 = [];
    $data = $this->fetchDishinfo($dish_id,"b");

    foreach($data as $key=>$value){
      $data2[$key]['number'] = $value['numberfield'];
      $data2[$key]['step'] = $value['textfield'];
    }
    return($data2);
    
  }
  // get all dish remarks from database
  public function selectRemarks($dish_id){
    $data = [];
    $data2 = [];
    $data = $this->fetchDishinfo($dish_id,"o");
    foreach($data as $key =>$value){
      $user_id = $value['users_id'];
      $data2[$key]['users'] = $this->fetchUser($user_id);
      $data2[$key]['remark'] = $value['textfield'];
    }
    return($data2);
  }

  // get compleet dish from database and send compleet back
  public function selectDish($dish_id){

    $data2=[];

    $data = $this->fetchDish($dish_id);
    $data['user_name'] = $this->selectUser($dish_id);
    $data['kitchen'] = $this->fetchKitchentype($data['kitchen_id'],"k");
    $data['type'] = $this->fetchKitchentype($data['type_id'],"t");
    $data['calories'] = $this->calcCalories($dish_id);
    $data['price'] = $this->calcPrice($dish_id);
    $data['rating'] = $this->selectRating($dish_id);
    $ingredient = $this->fetchIngredient($dish_id);
    $remarks = $this->selectRemarks($dish_id);
    $steps = $this->selectSteps($dish_id);

    $data2[0] = $data;
    $data2[1] = $ingredient;
    $data2[2] = $remarks;
    $data2[3] = $steps;
    return($data2);

  }
  // list of dishes
  public function selectDishes($dish_ids){

    foreach($dish_ids as $value){
      $data[] = $this->selectDish($value);
    }
    return($data);

  }

}

?>