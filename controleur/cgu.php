<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}


// recuperation des donnees GET, POST, et SESSION

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 

// traitement si necessaire des donnees recuperees
// creation du menu burger
$menuBurger = array();
$menuBurger[] = array("url" => "#top", "label" => "Conditions générales");
$menuBurger[] = array("url" => "#accpt", "label" => "Acceptation");
$menuBurger[] = array("url" => "#desc", "label" => "Description");
$menuBurger[] = array("url" => "#fonc", "label" => "Fonctionnalités");
$menuBurger[] = array("url" => "#mode", "label" => "Modération");
$menuBurger[] = array("url" => "#sanc", "label" => "Sanctions");
$menuBurger[] = array("url" => "#moti", "label" => "Motifs");
$menuBurger[] = array("url" => "#foncr", "label" => "Restaurateurs");
$menuBurger[] = array("url" => "#gene", "label" => "Généralités");
$menuBurger[] = array("url" => "#prot", "label" => "Données personnelles");
$menuBurger[] = array("url" => "#droi", "label" => "Droits d'accès");
$menuBurger[] = array("url" => "#util", "label" => "Données personnelles");
$menuBurger[] = array("url" => "#bila", "label" => "Bilan des fonctionnalités");



// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "r3st0.fr - Conditions générales d'utilisations";
include "$racine/vue/entete.html.php";
include "$racine/vue/vueCgu.php";
include "$racine/vue/pied.html.php";
