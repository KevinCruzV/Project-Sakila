<?php
function getAllCategories() {
    // Etape 1 : On se connecte à la BDD
    $pdo = getPDO();
    // Etape 2 : On prépare la requête
    $stmt = $pdo->prepare("SELECT * FROM category");
    // Etape 3 : On excute la requête
    $stmt->execute();
    // Etape 4 : On récupère les résultats
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCategory($id) {
    $pdo = getPDO();
    // Etape 2 : Je prépare la requête
    $stmt = $pdo->prepare("
    SELECT * FROM category 
    WHERE category_id = :id
    ");
    // Etape 3 : J'exécute la requête
    $stmt->execute([
    "id" => $id
    ]);
    // Etape 4 : Je récupère LE résultat
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getCategoryForFilm($id) {
    $pdo = getPDO();
    // Récupérer la catégorie du film
    $stmtCategory = $pdo->prepare("
    SELECT c.* FROM film_category fc 
    JOIN category c ON c.category_id = fc.category_id 
        AND fc.film_id = :id
    ");
    $stmtCategory->execute([
    "id" => $id
    ]);
    return $stmtCategory->fetch(PDO::FETCH_ASSOC);
}