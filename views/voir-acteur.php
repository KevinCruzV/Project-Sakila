<?php require_once('./views/tpl/header.php');
?>
<h1>Détails acteur <?= $actor["first_name"] . " " . $actor["last_name"] ?></h1>
<h2>Ses films</h2>
<table>
    <tr>
        <th>Titre</th>
        <th>Description</th>
        <th>Longueur</th>
        <th>Voir les détails</th>
    </tr>
    <?php foreach($films as $film): ?>
    <tr>
        <td><?= $film["title"] ?></td>
        <td><?= $film["description"] ?></td>
        <td><?= 
        // Si le film fait plus de 60min : affiche le nombre d'heures + "h"
        // Sinon, n'affiche rien
        (floor($film["length"] / 60) > 0
            ? floor($film["length"] / 60) . "h" 
            : "")
        . " " .
        // Si la longueur du film n'est pas un multiple de 60 (donc qu'il y a des minutes)
        // Afficher les minutes + "min"
        // Sinon, n'affiche rien
        ($film["length"] % 60 > 0
            ?  $film["length"] % 60 . "min"
            : "") ?></td>
        <td><a href="voir-film?id=<?= $film["film_id"] ?>">Voir les détails</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php require_once('./views/tpl/footer.php'); ?>