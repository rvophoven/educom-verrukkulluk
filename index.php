<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/kitchentype.php");


$db = new database();
$user = new user($db->getConnection());
$user_id = 1;
$artikel = new artikel($db->getConnection());
$artikel_id = 2;
$kitchentype = new kitchentype($db->getConnection());
$kitchen_id = 1;
$type_id = 3;

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


?>