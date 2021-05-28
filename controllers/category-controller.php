<?php
// Etape 1 : Ben ça commence ici
require_once('./inc/functions.php');
require_once('./models/actor-model.php');
require_once('./models/film-model.php');
require_once('./models/category-model.php');

function categories() {
    $categories = getAllCategories();
    require_once('./views/categories.php');
}

function voirCategorie() {
    $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
    $films = getFilmsForCategory($id);
    $category = getCategory($id);

    require_once('./views/voir-categorie.php');
}