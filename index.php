<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/kitchentype.php");
require_once("lib/dishinfo.php");


$db = new database();
$user = new user($db->getConnection());
$user_id = 2;
$artikel = new artikel($db->getConnection());
$artikel_id = 2;
$kitchentype = new kitchentype($db->getConnection());
$kitchen_id = 1;
$type_id = 3;
$dishinfo = new dishinfo($db->getConnection());
$dish_id = 1;
$record_type = "o";


//get artikel
$data = $artikel->selectArtikel($artikel_id);
var_dump($data);
echo "<pre>";
//get user
$data = $user->selectUser($user_id);
var_dump($data);
echo "<pre>";
//get kitchen
$data = $kitchentype->selectkitchentype($kitchen_id);
var_dump($data);
echo "<pre>";
//get type
$data = $kitchentype->selectkitchentype($type_id);
var_dump($data);
echo "<pre>";
//get dishinfo w
$data = $dishinfo->selectdishinfo($dish_id,$record_type);
var_dump($data);
echo "<pre>";
//add favorite
$data = $dishinfo->addfavorite($dish_id,$user_id);
echo "<pre>";
//delete favorite
$data = $dishinfo->deletefavorite($dish_id,$user_id);
echo "<pre>";




?>