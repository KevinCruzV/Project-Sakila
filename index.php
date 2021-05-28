<?php
// Je charge le fichier global où il y a toutes les fonctions
require_once('./inc/functions.php');

require_once('views/tpl/header.php');

// Je récupère le paramètre GET "view" qui représente la page
$view = filter_input(INPUT_GET, "view");
// J'appelle la fonction route qui permettra de choisir quelle
// fonction de contrôleur je vais appeler (en fonction de $view)
route($view);

require_once('views/tpl/footer.php');
