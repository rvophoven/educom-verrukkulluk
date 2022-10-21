<?php
class shoplist{

  private $connection;
  private $ingredient;

  public function __construct($connection) {
    $this->connection = $connection;
    $this->ingredient = new ingredient($connection);
  }

  public function fetchIngredient($dish_id){
    $data = $this->ingredient->selectIngredient($dish_id);// can also use this instead of $this->fetchIngredient.
    return($data);
  }

  public function selectShoplist($dish_ids){
    $data2=[];
    $data1=[];
    $data3=[];
    $data=[];
    $list=[];
    foreach($dish_ids as $value){
    $data = $this->fetchIngredient($value);//get per dish the artikels

      foreach($data as $key =>$value){//get per artikel in dish some values
        $data2[$key]['artikel_id'] = $value['artikel_id'];
        $data2[$key]['amount'] = $value['amount'];
        $data2[$key]['price'] = $value['price'];
        $data2[$key]['content'] = $value['content'];
      }
      $data3 = array_merge($data3,$data2);//merge dish ingredient to one array
    }
 
    foreach($data3 as $value){
      $key=$value['artikel_id'];
      //krsort sort array on key.
    }
   

    return($list);

  }


}

?>