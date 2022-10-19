<?php

define(USER,....);




class database{
  private $connection;

  public function __construct(){
    echo "Gestart";


$this -> connection = mysqli_connect(

  HOST, USER


  'lokalhost','root','root','ver1'//gebruiker aanmaken en ver1 is database in xammp
) or die("iets mis");


  }

}


?>

<?php // index
require_once(lib/database.php);
require_once(lib/artikel.php);

$db = new database();

$data 

?>

<?php //artikel fil
class Artikel{

  public function fetchArticele($id){


  }
}



?>