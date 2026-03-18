<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";
include_once "$racine/modele/bd.typecuisine.inc.php";
include_once "$racine/modele/bd.resto.inc.php";
include_once "$racine/modele/bd.aimer.inc.php";

// creation du menu burger
$menuBurger = array();
$menuBurger[] = array("url" => "./?action=profil", "label" => "Consulter mon profil");
$menuBurger[] = array("url" => "./?action=updProfil", "label" => "Modifier mon profil");



// recuperation des donnees GET, POST, et SESSION


if (isLoggedOn()) {
    $mailU = getMailULoggedOn();
    $util = getUtilisateurByMailU($mailU);

    $mesRestosAimes = getRestosAimesByMailU($mailU);

    $mesTypeCuisineAimes = getTypesCuisinePreferesByMailU($mailU);

    $estModerateur = isset($util["role"]) && $util["role"] == "moderateur";

    if ($estModerateur) { 
        $menuBurger[] = array("url" => "./?action=gererCritiques", "label" => "Gérer les critiques");
        $menuBurger[] = array("url" => "./?action=ajouterResto", "label" => "Ajouter un resto");
    }


    $titre = "Mon profil";
    include "$racine/vue/entete.html.php";
    include "$racine/vue/vueMonProfil.php";
    include "$racine/vue/pied.html.php";
} else {
    $titre = "Mon profil";
    include "$racine/vue/entete.html.php";
    include "$racine/vue/pied.html.php";
}
