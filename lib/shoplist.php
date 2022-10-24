<?php
class shoplist{

  private $connection;
  private $ingredient;

  public function __construct($connection) {//connect database
    $this->connection = $connection;
    $this->ingredient = new ingredient($connection);
  }

  public function fetchIngredient($dish_id){//function to get ingredients
    $data = $this->ingredient->selectIngredient($dish_id);// can also use this instead of $this->fetchIngredient later.
    return($data);
  }

  public function selectShoplist($dish_ids){
    $data=[];
    $data1=[];
    $data2=[];
    $list=[];
    foreach($dish_ids as $value){
    $data = $this->fetchIngredient($value);//get per dish the artikels

      foreach($data as $key =>$value){//get per artikel in dish some values
       // $data2[$key]['artikel_id'] = $value['artikel_id'];
        $data1[$key] = $value;//get all values
      }
      $data2 = array_merge($data2,$data1);//merge dish ingredient to one array
    }
 
    foreach($data2 as $value){//combine repeating ingredients and add amounts
      $key=$value['artikel_id'];

          if (!array_key_exists($key,$list))// if artikel does not exist in list make artikel in list with amount start total amount as
          {
            $list[$key]=$value;
            $list[$key]['total_amount']= $value['amount'];
          }
       else// if artikel exist add amount to total amount
          {
            $list[$key]['total_amount']+= $value['amount'];
          }         
    }
    return($list);

  }

}

?>