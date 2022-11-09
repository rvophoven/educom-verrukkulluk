<?php
session_start();
//session_destroy();


//// Allereerst zorgen dat de "Autoloader" uit vendor opgenomen wordt:
require_once("./vendor/autoload.php");

/// Twig koppelen:
$loader = new \Twig\Loader\FilesystemLoader("./templates");
/// VOOR PRODUCTIE:
/// $twig = new \Twig\Environment($loader), ["cache" => "./cache/cc"]);

/// VOOR DEVELOPMENT:
$twig = new \Twig\Environment($loader, ["debug" => true ]);
$twig->addExtension(new \Twig\Extension\DebugExtension());


/******************************/
/*connect database */
require_once("lib/database.php");
$db = new database();


/// Next step, iets met je data doen. Ophalen of zo
/*get classes/functions*/
require_once("lib/dish.php");
require_once("lib/shoplist.php");
$dish = new dish($db->getConnection());
$list = new shoplist($db->getConnection());
$data = $dish->selectDishes();

/*
URL:
http://localhost/index.php?gerecht_id=4&action=detail
*/

/*set/get variables */

if ($_SERVER["REQUEST_METHOD"] == "POST") {/*still need to finish!!!*/
    /*get email and password*/
    $password = $_POST["password"];
    $email = $_POST["email"];
    /*check email and password*/

    /*correct? login*/
    $action = $_POST["action"];
    /*incorrect? error*/
    
}

$gerecht_id[] = isset($_GET["gerecht_id"]) ? $_GET["gerecht_id"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "homepage";
$rating = isset($_GET["rating"]) ? $_GET["rating"] : "";
$searchText = isset($_GET["search"]) ? $_GET["search"] : "";
$lijst_id = isset($_GET["lijst_id"]) ? $_GET["lijst_id"] : "";
/*login data*/
$user["id"] = 1;
$user["like"]  = $dish->likesUser($user["id"]);



/*switch between pages or actions */
switch($action) {

        case "homepage": {/*get dishes and show homepage*/
            $data = $dish->selectDishes();
            $template = 'homepage.html.twig';
            $title = "homepage";
            break;
        }

        case "detail": {/*get dish and show detailpage*/
            $data = $dish->selectDishes($gerecht_id);
            $template = 'detail.html.twig';
            $title = "detail pagina";
            break;
        }

        case "shoplist": {/*add dish and show shoppage*/
            $_SESSION['lijst'][] = $lijst_id;//add dish id to shoplist session variables
            $data = $list->selectShoplist($_SESSION['lijst']);//load all dishes added to shoplist
            $template = 'shoplist.html.twig';
            $title = "shoplist pagina";
            break;
        }

        case "addLike": {/*add like to database*/
           $dish->addLike($gerecht_id[0],$user["id"]);
            break;
        }

        case "delLike": {/*delete like in database*/
            $dish->deleteLike($gerecht_id[0],$user["id"]);
            break;
        }

        case "addRating": {/*add start rating to database*/
            $dish->addStars($gerecht_id[0],$rating);
            break;
        }

        case "search": {/*get search and show result on homepage*/
            $data = $dish->getSearch($searchText);
            $template = 'homepage.html.twig';
            $title = "homepage";
            break;
        }

        case "shoppage": {/* show shoppage*/ 
            $data = [];                   
            if(isset($_SESSION['lijst']) && !empty($_SESSION['lijst'])) {//check if shoppage list is empty
                $data = $list->selectShoplist($_SESSION['lijst']);//load all dishes added to shoplist
             }
            $template = 'shoplist.html.twig';
            $title = "shoplist pagina";
            break;
        }

        case "likepage": {/* show liked dishes on homepage*/
            $data = $dish->selectDishes($user["like"]);
            $template = 'homepage.html.twig';
            $title = "homepage";
            break;
        }

        case "login" : {//still need to finish
            $_SESSION["Login"] = true;
            $template = 'homepage.html.twig';
            $title = "homepage";

            break;
        }

        case "logout" : {//still need to finish
            session_unset();
            $_SESSION["Login"] = false;
            $template = 'homepage.html.twig';
            $title = "homepage";
            
            break;
        }
}


$twig->addGlobal('session', $_SESSION);
/// Juiste template laden, in dit geval "homepage"
$template = $twig->load($template);


/// En tonen die handel!
echo $template->render(["title" => $title, "data" => $data, "user" => $user]);


