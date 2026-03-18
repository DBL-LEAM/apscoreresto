<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";
include_once "$racine/modele/bd.critiquer.inc.php";
include_once "$racine/modele/bd.resto.inc.php";

// creation du menu burger
$menuBurger = array();
$menuBurger[] = array("url" => "./?action=profil", "label" => "Consulter mon profil");
$menuBurger[] = array("url" => "./?action=updProfil", "label" => "Modifier mon profil");
$menuBurger[] = array("url" => "./?action=gererCritiques", "label" => "Gérer les critiques");
$menuBurger[] = array("url" => "./?action=ajouterResto", "label" => "Ajouter un resto");

// Vérifier que l'utilisateur est modérateur
if (isLoggedOn()) {
    $mailU = getMailULoggedOn();
    $util = getUtilisateurByMailU($mailU);

    // Vérifier si l'utilisateur est modérateur
    if (!empty($util["role"]) && $util["role"] == "moderateur") {
        // Récupérer les critiques en attente
        $critiquesEnAttente = getCritiquesEnAttente();

        $titre = "Gérer les critiques";
        include "$racine/vue/entete.html.php";
        include "$racine/vue/vueGererCritique.php";
        include "$racine/vue/pied.html.php";
    } else {
        // L'utilisateur n'est pas modérateur
        header("Location: ./?action=profil");
        exit();
    }
} else {
    // L'utilisateur n'est pas connecté
    header("Location: ./?action=connexion");
    exit();
}
