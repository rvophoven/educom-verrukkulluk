<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");


$db = new database();
$user = new user($db->getConnection());
$user_id = 1;
$artikel = new artikel($db->getConnection());
$artikel_id = 2;

$data = $artikel->allArtikel($artikel_id);
var_dump($data);
echo "<pre>";
$data = $user->allUser($user_id);
var_dump($data);
echo "<pre>";

?>