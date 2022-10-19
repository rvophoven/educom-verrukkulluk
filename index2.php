<?php

require_once("lib/database.php");
require_once("lib/artikel2.php");
require_once("lib/user2.php");


$db = new database();
$user = new user($db->getConnection());
$user_id = 1;
$artikel = new artikel($db->getConnection());
$artikel_id = 2;

$data = $artikel->allArtikel($artikel_id);
var_dump($data);
echo "<pre>";
$data = $user->searchUser($user_id);
var_dump($data);
echo "<pre>";
$data = $artikel->searchArtikel();
var_dump($data);
?>