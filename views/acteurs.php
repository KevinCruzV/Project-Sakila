<?php require_once('./views/tpl/header.php'); ?>
<h1>Tous les acteurs et actrices</h1>
<?php if($page > 0): ?>
<a href="acteurs?page=<?= $page - 1 ?>">Page précente</a>
<?php endif; ?>
<a href="acteurs?page=<?= $page + 1 ?>">Page suivante</a>
<table>
    <tr>
        <th>Nom complet</th>
        <td>Détails</td>
    </tr>
    <?php foreach($actors as $actor): ?>
    <tr>
        <td><?= $actor["first_name"] . " " . $actor["last_name"] ?></td>
        <td>
            <a href="voir-acteur?id=<?= $actor["actor_id"] ?>">
                Voir les détails
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php require_once('./views/tpl/footer.php'); ?>