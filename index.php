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

$gerecht_id = isset($_GET["gerecht_id"]) ? $_GET["gerecht_id"] : "";

/// Next step, iets met je data doen. Ophalen of zo
require_once("lib/dish.php");
$gerecht = new dish($db->getConnection());
$data = $gerecht->selectDish($gerecht_id);



/*
URL:
http://localhost/index.php?gerecht_id=4&action=detail
*/


$gerecht_id = isset($_GET["gerecht_id"]) ? $_GET["gerecht_id"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "homepage";


switch($action) {

        case "homepage": {
            $data = $gerecht->selectDish($gerecht_id);
            $template = 'detail.html.twig';
            $title = "homepage";
            break;
        }

        case "detail": {
            $data = $gerecht->selectDish($gerecht_id);
            $template = 'detail.html.twig';
            $title = "detail pagina";
            break;
        }

        /// etc

}


/// Onderstaande code schrijf je idealiter in een layout klasse of iets dergelijks
/// Juiste template laden, in dit geval "homepage"
$template = $twig->load($template);


/// En tonen die handel!
echo $template->render(["title" => $title, "data" => $data]);


