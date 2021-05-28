<?php
// Etape 1 : Ben ça commence ici
require_once('./inc/functions.php');
require_once('./models/actor-model.php');
require_once('./models/film-model.php');
require_once('./models/category-model.php');

function acteurs() {
    $page = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
    // Nombre d'acteurs/actrices par page
    $pageLength = 30;
    // Numéro d'acteur/actrice à partir duquel on affiche
    $start = $page * 30;
    // On va chercher les acteurs paginés
    $actors = getPaginatedActors($start, $pageLength);

    // Etape 4 et 5 : On récupère la vue
    require_once('./views/acteurs.php');
}

function aleatoire() {
    $nbActors = countActors();
    $aleatoire = rand(1, $nbActors);

    $actor = getActor($aleatoire);
    $films = getFilmsForActor($aleatoire);

    $categories = [];
    foreach($films as $film) {
        $category = getCategoryForFilm($film["film_id"]);
        $categories[$category["category_id"]] = $category;
    }

    $films = array_slice($films, 0, 3);

    var_dump($actor);
    var_dump($films);
    var_dump($categories);
}

function voirActeur() {
    $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
    $actor = getActor($id);
    $films = getFilmsForActor($id);
    
    require_once('./views/voir-acteur.php');
}