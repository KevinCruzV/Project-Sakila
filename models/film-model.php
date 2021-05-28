<?php
function getPaginatedFilms($start, $pageLength) {
    // On se connecte à la base de données
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT * FROM film LIMIT :start, :pl"); // De ($_GET["page"]*50) à ($_GET["page"]*50)+49
    // bindValue agit comme le tableau de execute()
    // Cette fonction permet de préciser un type (ici un nombre entier)
    // pour éviter les éventuelles erreurs de syntaxe SQL
    // En effet, quand on utilise execute(), la valeur est mise entre guillemets
    // dans la requête (entre autres transformations réalisées par PDO), et
    // LIMIT '0', '50' n'est pas valide en SQL
    // Pour forcer l'absence de guillemets et passer des nombres entiers
    // il faut utiliser bindValue avec le type PDO::PARAM_INT
    $stmt->bindValue(":start", $start, PDO::PARAM_INT);
    $stmt->bindValue(":pl", $pageLength, PDO::PARAM_INT);
    $stmt->execute();
    // On entoure avec des "guillemets"
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getFilmsForActor($id) {
    $pdo = getPDO();
    // Etape 2 : On prépare la requête
    $stmt = $pdo->prepare("
    SELECT film.* FROM film_actor
    JOIN film ON film_actor.film_id = film.film_id
    WHERE actor_id = :id
    ");
    // Etape 3 : On exécute la requête
    $stmt->execute([
    "id" => $id
    ]);
    // Etape 4 : On récupère LES films
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getFilmsForCategory($id) {
    // Etape 1 : Je me connecte à la base de données
    $pdo = getPDO();
    // Etape 2 : Je prépare la requête
    $stmt = $pdo->prepare("
        SELECT film.* FROM film_category
        JOIN film ON film_category.film_id = film.film_id
        WHERE category_id = :id
    ");
    // Etape 3 : J'exécute la requête
    $stmt->execute([
        "id" => $id
    ]);
    // Etape 4 : Je récupère les résultats
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getFilm($id) {
    // On se connecte à la base de données
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM film WHERE film_id = :id");
    // Le execute() ci-dessous est équivalent à ces deux lignes :
    // - $stmt->bindValue(":id", $id);
    // - $stmt->execute();
    $stmt->execute([
        "id" => $id
    ]);
    // Je récupère UN film
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function countFilms() {
    // On se connecte à la base de données
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT COUNT(*) as cnt FROM film");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return (int)$result["cnt"];
}