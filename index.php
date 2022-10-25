<?php
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
require_once("lib/database.php");
$db = new database();


/// Next step, iets met je data doen. Ophalen of zo
require_once("lib/dish.php");
$dish = new dish($db->getConnection());
$list = new shoplist($db->getConnection());
$data = $dish->getDishes();
$dish_ids = $dish->getDishesID();



/*
URL:
http://localhost/index.php?gerecht_id=4&action=detail
*/


$gerecht_id = isset($_GET["gerecht_id"]) ? $_GET["gerecht_id"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "homepage";


switch($action) {

        case "homepage": {
            $data = $dish->getDishes();
            $template = 'homepage.html.twig';
            $title = "homepage";
            break;
        }

        case "detail": {
            $data = $dish->getDishes();
            $template = 'detail.html.twig';
            $title = "detail pagina";
            break;
        }

        case "shoplist": {
            $data = $dish->getDishes();
            $template = 'detail.html.twig';
            $title = "shoplist pagina";
            break;
        }

        /// etc

}
/*page 1: id 1e,2e,3e,4e- page 2: id 5e,6e,7e,8e.... */


/// Onderstaande code schrijf je idealiter in een layout klasse of iets dergelijks
/// Juiste template laden, in dit geval "homepage"
$template = $twig->load($template);


/// En tonen die handel!
echo $template->render(["title" => $title, "data" => $data]);


