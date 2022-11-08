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
require_once("lib/search.php");
$dish = new dish($db->getConnection());
$list = new shoplist($db->getConnection());
$search = new search($db->getConnection());
$data = $dish->selectDishes();
$search_id = [];



/*
URL:
http://localhost/index.php?gerecht_id=4&action=detail
*/

/*set/get variables */
$gerecht_id[] = isset($_GET["gerecht_id"]) ? $_GET["gerecht_id"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "homepage";
$rating = isset($_GET["rating"]) ? $_GET["rating"] : "";
$searchText = isset($_GET["search"]) ? $_GET["search"] : "";
$lijst_id = isset($_GET["lijst_id"]) ? $_GET["lijst_id"] : "";
/*login data*/
$user["id"] = 1;
$user["like"]  = $dish->likesUser($user["id"]);

$main = 'main.html.twig';

/*switch between pages or actions */
switch($action) {

        case "homepage": {
            $data = $dish->selectDishes();
            $template = 'homepage.html.twig';
            $title = "homepage";
            break;
        }

        case "detail": {
            $data = $dish->selectDishes($gerecht_id);
            $template = 'detail.html.twig';
            $title = "detail pagina";
            break;
        }

        case "shoplist": {
            $_SESSION['lijst'][] = $lijst_id;//add dish id to shoplist session variables
            $data = $list->selectShoplist($_SESSION['lijst']);//load all dishes added to shoplist
            $template = 'shoplist.html.twig';
            $title = "shoplist pagina";
            break;
        }

        case "addLike": {
           $dish->addLike($gerecht_id[0],$user["id"]);
            break;
        }

        case "delLike": {
            $dish->deleteLike($gerecht_id[0],$user["id"]);
            break;
        }

        case "addRating": {/*add start rating to database*/
            $dish->addStars($gerecht_id[0],$rating);
            break;
        }

        case "search": {
            $search_id = $search->getSearch($searchText);
            $data = $dish->selectDishes($search_id);
            $template = 'homepage.html.twig';
            $title = "homepage";
            break;
        }

        /// etc

}
/*page 1: id 1e,2e,3e,4e- page 2: id 5e,6e,7e,8e.... */


/// Onderstaande code schrijf je idealiter in een layout klasse of iets dergelijks
/// Juiste template laden, in dit geval "homepage"
$template = $twig->load($template);


/// En tonen die handel!
echo $template->render(["title" => $title, "data" => $data, "user" => $user]);


