<?php require_once('./views/tpl/header.php'); ?>
<h1>Liste des catégories</h1>
<table>
    <tr>
        <th>Nom</th>
    </tr>
    <?php foreach($categories as $category): ?>
    <tr>
        <td>
            <a href="voir-categorie?id=<?= $category["category_id"] ?>">
                <?= $category["name"] ?>
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php require_once('./views/tpl/footer.php'); ?>