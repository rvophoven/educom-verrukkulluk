<?php 

// Aanpassen naar je eigen omgeving
define("USER", "visual");
define("PASSWORD", "1234");
define("DATABASE", "verruk3");
define("HOST", "localhost");

class database {

    private $connection;

    public function __construct() {
       $this->connection = mysqli_connect(HOST,                                          
                                         USER, 
                                         PASSWORD,
                                         DATABASE );
    }

    public function getConnection() {
        return($this->connection);
    }

}
