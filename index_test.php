<!-- some test code.............................................--> 
<?php



// get lib classes
require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/kitchentype.php");
require_once("lib/dishinfo.php");
require_once("lib/ingredients.php");
require_once("lib/dish.php");
require_once("lib/shoplist.php");
require_once("lib/search.php");

// connect to database...........................................
$db = new database();
$user = new user($db->getConnection());
$artikel = new artikel($db->getConnection());
$kitchentype = new kitchentype($db->getConnection());
$dishinfo = new dishinfo($db->getConnection());
$ingredient = new ingredient($db->getConnection());
$dish = new dish($db->getConnection());
$shoplist = new shoplist($db->getConnection());
$search = new search($db->getConnection());


// set some test values..........................................
$user_id = 1;
$dish_id = 3;
$record_type = "o";
$kitchen_id = 1;
$type_id = 3;
$artikel_id = 2;
$dish_ids = array(1,2);
$stars = 3;
$search_id = [1,2];
$searchText = "in";

$search_id = $search->getSearch($searchText);
var_dump($search_id);
//show data database with function/methode classes................
//get artikel
$data = $artikel->selectArtikel($artikel_id);
var_dump($data);
echo "<pre>";
//get user
$data = $user->selectUser($user_id);
var_dump($data);
echo "<pre>";
//get kitchen
$data = $kitchentype->selectKitchentype($kitchen_id);
var_dump($data);
echo "<pre>";
//get type
$data = $kitchentype->selectKitchentype($type_id);
var_dump($data);
echo "<pre>";
//add rating w.................................................................................
$data = $dish->addStars($dish_id,$stars);
var_dump( $stars);
echo "<pre>";
//get dishinfo w.....................................................................................
$data = $dishinfo->selectDishinfo($dish_id,$record_type);
var_dump($data);
echo "<pre>";
//add favorite
$data = $dishinfo->addfavorite($dish_id,$user_id);
var_dump( "add fav");
//echo "<pre>";
//delete favorite
//$data = $dishinfo->deleteFavorite($dish_id,$user_id);
echo "<pre>";
//get ingredients
$data = $ingredient->selectIngredient($dish_id);
var_dump($data);
echo "<pre>";
//get dish user
$data = $dish->selectUser($dish_id);
var_dump($data);
echo "<pre>";
//get dish ingredients
$data = $dish->selectIngredient($dish_id);
var_dump($data);
echo "<pre>";
//get callories
$data = $dish->calcCalories($dish_id);
var_dump($data);
echo "<pre>";
//get callories
$data = $dish->calcPrice($dish_id);
var_dump($data);
echo "<pre>";
//get waardering
$data = $dish->selectRating($dish_id);
var_dump($data);
echo "<pre>";
//get preperation
$data = $dish->selectSteps($dish_id);
var_dump($data);
echo "<pre>";
//get review
$data = $dish->selectRemarks($dish_id);
var_dump($data);
echo "<pre>";
echo "Break.....selectDish...........................................";
echo "<pre>";
//get dish
$data = $dish->selectDish($dish_id);
var_dump($data);
echo "<pre>";
echo "Break.......selectDishes........................................";
echo "<pre>";
//get dishes
$data = $dish->selectDishes($dish_ids);
var_dump($data);
echo "<pre>";
echo "Break.......selectList.........................................";
echo "<pre>";
//get dishes
$data = $shoplist->selectShoplist($dish_ids);
var_dump($data);
echo "<pre>";
echo "<pre>";
echo "Break..........getDishes......................................";
echo "<pre>";
$data = $dish->getDishes();
var_dump($data);
echo "<pre>";


?>