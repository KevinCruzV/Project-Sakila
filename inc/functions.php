<?php 
// Fichier avec plein de fonctions utiles
// pour le site en général.

// Dans tous les cas, on démarre la session
session_start();

// On va charger tous les contrôleurs (on peut optimiser mais
// ce n'est pas si grave dans le cadre de ce site)
require_once('./controllers/actor-controller.php');
require_once('./controllers/film-controller.php');
require_once('./controllers/category-controller.php');

// A partir d'ici, on ne fait que déclarer des fonctions :
// ----
// La fonction pour se connecter à la base de données, utile pour
// les modèles
function getPDO() {
    return new PDO("mysql:host=localhost;dbname=sakila", "root", "", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}

// La fonction pour savoir quelle fonction de contrôleur appeler
// en fonction de $page.
// Ce n'est qu'un switch avec pour default (si rien ne correspond)
// une 404.
function route($page) {
    switch($page) {
        case "":
            echo "Bonjour page d'accueil";
            break;
        case "acteurs": 
            acteurs();
            break;
        case "aleatoire":
            aleatoire();
            break;
        case "categories":
            categories();
            break;
        case "films":
            films();
            break;
        case "voir-acteur":
            voirActeur();
            break;
        case "voir-categorie":
            voirCategorie();
            break;
        case "voir-film":
            voirFilm();
            break;
        case "ma-page-cachee":
            echo "Hin hin je suis caché(e)";
            break;
        default:
        /*
            $path = realpath(__DIR__ . "/../views/" . $page);
            if(file_exists($path)) {
                if(substr($path, -4) == ".css") {
                    header('Content-Type: text/css');
                }
                echo file_get_contents($path);
                exit();
            }
        */
            http_response_code(404);
            require_once('./views/errors/404.php');
            exit();
    }
}