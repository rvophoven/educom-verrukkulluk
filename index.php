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
require_once("lib/user.php");
$dish = new dish($db->getConnection());
$list = new shoplist($db->getConnection());
$user = new user($db->getConnection());
$data = $dish->selectDishes();

/*
URL:
http://localhost/index.php?gerecht_id=4&action=detail
*/
function test_input($data) {/*filter input */
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


/*set post or get variables */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /*get email and password*/
    $password = test_input($_POST["password"]);
    $email = test_input($_POST["email"]);
    /*check email and password*/
    $userlog = $user->loginUser($email,$password);

    /*correct? login*/
    if ($userlog["id"] >0){
        $action = "login";
        $_SESSION['id'] = $userlog["id"];
        $_SESSION['name'] = $userlog["user_name"];
        $_SESSION['like'] = $dish->likesUser($_SESSION['id']);
        $_SESSION['error'] = "";
    }else{/*incorrect? error*/
        $action = "homepage";
        $_SESSION['error'] = "A field is incorrect";
    }
    
}else{//set get
    $gerecht_id[] = isset($_GET["gerecht_id"]) ? $_GET["gerecht_id"] : "";
    $action = isset($_GET["action"]) ? $_GET["action"] : "homepage";
    $rating = isset($_GET["rating"]) ? $_GET["rating"] : "";
    $searchText = isset($_GET["search"]) ? $_GET["search"] : "";
    $lijst_id = isset($_GET["lijst_id"]) ? $_GET["lijst_id"] : "";
    $_SESSION['pages'] = isset($_GET["page"]) ? $_GET["page"] : 1;
}

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
           $dish->addLike($gerecht_id[0],$_SESSION['id']);
           
           $_SESSION['like'] = $dish->likesUser($_SESSION['id']);
            break;
        }

        case "delLike": {/*delete like in database*/
            $dish->deleteLike($gerecht_id[0],$_SESSION['id']);
            
            $_SESSION['like'] = $dish->likesUser($_SESSION['id']);
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
            
            $_SESSION['like'] = $dish->likesUser($_SESSION['id']);
            $data = $dish->selectDishes($_SESSION['like']);
            $_SESSION["pages"] = 0;
            $template = 'homepage.html.twig';
            $title = "likepage";
            break;
        }

        case "login" : {//login user
            $_SESSION["Login"] = true;
            $template = 'homepage.html.twig';
            $title = "homepage";

            break;
        }

        case "logout" : {//logout user
            session_unset();
            $_SESSION["Login"] = false;
            $_SESSION["pages"] = 1;
            $template = 'homepage.html.twig';
            $title = "homepage";
            
            break;
        }

}


$twig->addGlobal('session', $_SESSION);//set global variables
/// Juiste template laden, in dit geval "homepage"
$template = $twig->load($template);


/// En tonen die handel!
echo $template->render(["title" => $title, "data" => $data]);


