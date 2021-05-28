<?php
// Etape 1 : Ben ça commence ici
require_once('./inc/functions.php');
require_once('./models/actor-model.php');
require_once('./models/film-model.php');
require_once('./models/category-model.php');

function films()
{    // On récupère le paramètre en GET ?page=x où x est un nombre entier
    $page = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
    if (!$page) $page = 0;
    // Nombre de films par page
    $pageLength = 50;
    // Numéro de film à partir duquel on affiche
    $start = $page * $pageLength;

    $films = getPaginatedFilms($start, $pageLength);
    $nbFilms = countFilms();

    // canGoPrevPage et canGoNextPage sont des booléens
    // représentants si l'on peut aller sur respectivement
    // la page précédente et la page suivante.
    // Pour eux deux, on vérifie si un nombre est strictement
    // supérieur à un autre.
    $canGoPrevPage = $page > 0;
    $canGoNextPage = $nbFilms / $pageLength > $page + 1;

    require_once('./views/films.php');
}

function voirFilm()
{
    // On récupère le paramètre en GET ?id=x où x est un nombre entier
    $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
    if (!$id) {
        // L'id n'a pas été envoyé ou alors c'était pas un nombre
        echo "400 Bad Request";
        http_response_code(400);
        exit();
    }

    $film = getFilm($id);
    if (!$film) {
        // On n'a pas trouvé le film, l'id envoyé n'existe pas dans la base
        echo "404 Not Found";
        http_response_code(404);
        exit();
    }

    $category = getCategoryForFilm($id);
    $actors = getActorsForFilm($id);

    require_once('./views/voir-film.php');
}
