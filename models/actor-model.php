<?php
function getPaginatedActors($start, $pageLength) {
    // Etape 1 : On crée la connexion
    $pdo = getPDO();
    // Etape 2 : On prépare la requête
    $stmt = $pdo->prepare("SELECT * FROM actor LIMIT :start, :pl"); // De ($_GET["page"]*50) à ($_GET["page"]*50)+49
    // Etape 3 : On exécute la requête
    $stmt->bindValue(":start", $start, PDO::PARAM_INT);
    $stmt->bindValue(":pl", $pageLength, PDO::PARAM_INT);
    $stmt->execute();
    // Etape 4 : On récupère les résultats
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getActor($id) {
    // Etape 1 : On crée une connexion à la base de données
    $pdo = getPDO();
    // Etape 2 : On prépare la requête
    $stmt = $pdo->prepare("SELECT * FROM actor WHERE actor_id = :id");
    // Etape 3 : On exécute la requête
    $stmt->execute([
        "id" => $id
    ]);
    // Etape 4 : On récupère LE résultat
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getActorsForFilm($id) {
    $pdo = getPDO();
    // Récupérer les acteurs/actrices du film
    $stmtActors = $pdo->prepare("
    SELECT a.* FROM film_actor fa 
    JOIN actor a ON a.actor_id = fa.actor_id 
            AND fa.film_id = :id
    ");
    $stmtActors->execute([
    "id" => $id
    ]);
    // document.querySelector() -> 1 élément
    // document.querySelectorAll() -> Un tableau d'éléments
    return $stmtActors->fetchAll(PDO::FETCH_ASSOC);
}

function countActors() {
    // On se connecte à la base de données
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT COUNT(*) as cnt FROM actor");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return (int)$result["cnt"];
}