<?php
require_once("lib/database.php");// testing some code
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/kitchentype.php");
require_once("lib/dishinfo.php");
require_once("lib/ingredients.php");
//require_once("lib/dish.php");
//require_once("lib/shoplist.php");


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
  public function fetchIngredient($dish_id){
    $data = $this->ingredient->selectIngredient($dish_id);// can also use this instead of $this->fetchIngredient.
    return($data);
  }

  public function fetchUser($user_id){// get user name and picture
    $data2 = [];
    $data = $this->users->selectUser($user_id);
    $data2['user_name'] = $data['user_name'];
    $data2['picture'] = $data['picture'];
    return($data2);
  }

  public function likesUser($user_id =0){// get likes from user
    $data2 = [];
    $data = $this->dishinfo->selectLikes($user_id);
    foreach($data as $value){
    $data2[] = $value["dish_id"];
    }
    return($data2);
  }

  public function fetchDishinfo($artikel_id,$record_type){
    $data = $this->dishinfo->selectDishinfo($artikel_id,$record_type);
    return($data);
  }

  public function deleteLike($dish_id,$user_id){
    $data = $this->dishinfo->deleteFavorite($dish_id,$user_id);
    return($data);
  }

  public function addLike($dish_id,$user_id){
    $data = $this->dishinfo->addFavorite($dish_id,$user_id);
    return($data);
  }

  public function fetchKitchentype($artikel_id,$record_type){
    $data = $this->kitchentype->selectKitchentype($artikel_id,$record_type);
    $data = $data['description'];
    return($data);
  }

  public function fetchDish($dish_id){
    $sql = "select * from dish";// if 0 get first dish
    if($dish_id > 0) {// if >0 get dish_id
      $sql .= " where id = $dish_id";
    }
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
      $data = $data['user_name'];
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
    if($dish_id>0){$rating = $rating/count($data);}
    
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
      $data = $this->fetchUser($user_id);
      $data2[$key]['users'] = $data['user_name'];
      $data2[$key]['picture'] = $data['picture'];
      $data2[$key]['remark'] = $value['textfield'];
    }
    return($data2);
  }

  // get dish from database and send back with extra info
  public function selectDish($dish_id =0){

    $data2=[];

    $data = $this->fetchDish($dish_id);
    $dish_id=$data['id'];
    $data['user_name'] = $this->selectUser($dish_id);
    $data['kitchen'] = $this->fetchKitchentype($data['kitchen_id'],"k");
    $data['type'] = $this->fetchKitchentype($data['type_id'],"t");
    $data['calories'] = $this->calcCalories($dish_id);
    $data['price'] = $this->calcPrice($dish_id);
    $data['rating'] = $this->selectRating($dish_id);
    $ingredient = $this->fetchIngredient($dish_id);
    $remarks = $this->selectRemarks($dish_id);
    $steps = $this->selectSteps($dish_id);

    $data2['dish'] = $data;
    $data2['dish']['ingredients'] = $ingredient;
    $data2['dish']['remarks'] = $remarks;
    $data2['dish']['steps'] = $steps;
    return($data2);

  }
  //get list of dishes with info
  public function selectDishes($dish_ids =0){

    if(!$dish_ids>0){// if no id get all dishes in order of date
      $dish_ids = $this->getDishesID();
    }

    foreach($dish_ids as $value){
      $data[] = $this->selectDish($value);
    }
    return($data);

  }
  // get dishes without ids
  public function getDishes(){
    //get dish id's orderd by date
    $sql = "SELECT id  FROM dish ORDER BY dat_added DESC";
    $result = mysqli_query($this->connection, $sql);
    //per id get dish
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
      $data[] = $this->selectDish($row['id']);
      }
    return($data);
  }

  public function getDishesID(){
    //get dish id's orderd by date
    $sql = "SELECT id  FROM dish ORDER BY dat_added DESC";
    $result = mysqli_query($this->connection, $sql);
    // ids dishes
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
      $data[] =$row['id'];
      }
    return($data);
  }

  public function getSearch($searchText){
    $dishes = $this->selectDishes();
    $data = [];
    
    foreach($dishes as $dish){
      $text = json_encode(array_values($dish));//array to json
      $textNoNum = preg_replace('/[0-9]+/', '', $text);//no number search
      if(strpos(strtoupper($textNoNum),strtoupper($searchText)) !== false){
        $data[] = $dish;
      }
    }
    return($data);
  }


}

?>