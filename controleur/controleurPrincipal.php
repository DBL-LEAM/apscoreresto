<?php

function controleurPrincipal($action) {
    $lesActions = array();
    $lesActions["defaut"] = "listeRestos.php";
    $lesActions["liste"] = "listeRestos.php";
    $lesActions["detail"] = "detailResto.php";
    $lesActions["recherche"] = "rechercheResto.php";
    $lesActions["connexion"] = "connexion.php";
    $lesActions["deconnexion"] = "deconnexion.php";
    $lesActions["profil"] = "monProfil.php";
    $lesActions["cgu"] = "cgu.php";
    $lesActions["aimer"] = "aimer.php";
    $lesActions["inscription"] = "inscription.php";
    $lesActions["updProfil"] = "updProfil.php";
    $lesActions["critiques"] = "critiques.php";
    $lesActions["delCritique"] = "delCritique.php";
    $lesActions["noter"] = "note.php";
// echo '<pre>';
// print_r($lesActions);
// echo '</pre>';

    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } 
    else {
        return $lesActions["defaut"];
    }
}

?>