<?php require_once('./views/tpl/header.php');
?>
<h1><?= $film["title"] ?></h1>
<p><?= $film["description"] ?></p>
<em><?= 
    (floor($film["length"] / 60) > 0
        ? floor($film["length"] / 60) . "h" 
        : "")
    . " " .
    ($film["length"] % 60 > 0
        ?  $film["length"] % 60 . "min"
        : "")
?></em>
<strong>
    <a href="voir-categorie?id=<?= $category["category_id"] ?>">
        <?= $category["name"] ?>
    </a>
</strong>
<ul>
<?php foreach($actors as $actor): ?>
    <li>
        <a href="voir-acteur?id=<?= $actor["actor_id"] ?>">
            <?= $actor["first_name"] . " " . $actor["last_name"] ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>

<a href="voir-film?id=<?= $id - 1 ?>">Film précédent</a>
<a href="voir-film?id=<?= $id + 1 ?>">Film suivant</a>
<?php require_once('./views/tpl/footer.php'); ?>