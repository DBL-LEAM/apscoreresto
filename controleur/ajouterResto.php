<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";
include_once "$racine/modele/bd.resto.inc.php";

// creation du menu burger
$menuBurger = array();
$menuBurger[] = array("url" => "./?action=profil", "label" => "Consulter mon profil");
$menuBurger[] = array("url" => "./?action=updProfil", "label" => "Modifier mon profil");
$menuBurger[] = array("url" => "./?action=gererCritiques", "label" => "Gérer les critiques");
$menuBurger[] = array("url" => "./?action=ajouterResto", "label" => "Ajouter un resto");

$ajoutSuccess = false;
$msg = "";

if (isLoggedOn()) {
    $mailU = getMailULoggedOn();
    $util = getUtilisateurByMailU($mailU);

    if (!empty($util["role"]) && $util["role"] == "moderateur") {
        if (!empty($_POST["nomR"]) && !empty($_POST["descR"]) && isset($_POST["numAdrR"]) && !empty($_POST["voieAdrR"]) && !empty($_POST["cpR"]) && !empty($_POST["villeR"])) {

            $nomR = $_POST["nomR"];
            $descR = $_POST["descR"];
            $numAdrR = $_POST["numAdrR"];
            $voieAdrR = $_POST["voieAdrR"];
            $cpR = $_POST["cpR"];
            $villeR = $_POST["villeR"];
            
            // Assembler les horaires jour par jour
            $jours = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");
            $horairesArray = array();
            
            foreach ($jours as $jour) {
                if (!empty($_POST[$jour])) {
                    $horairesArray[] = ucfirst($jour) . " : " . $_POST[$jour];
                } else {
                    $horairesArray[] = ucfirst($jour) . " : Fermé";
                }
            }
            
            $horairesR = implode("\n", $horairesArray);

            if ($nomR != "" && $voieAdrR != "" && $cpR != "" && $villeR != "") {
                $ret = addResto($nomR, $descR, $numAdrR, $voieAdrR, $cpR, $villeR, $horairesR);
                if ($ret) {
                    $ajoutSuccess = true;
                    $msg = "Le restaurant a été ajouté avec succès.";
                } else {
                    $msg = "Une erreur est survenue lors de l'ajout du restaurant.";
                }
            } else {
                $msg = "Veuillez renseigner les champs obligatoires.";
            }
        }
    } else {
        header("Location: ./?action=profil");
        exit();
    }
} else {
    header("Location: ./?action=connexion");
    exit();
}

$titre = "ajouter un restaurant";
include "$racine/vue/entete.html.php";
include "$racine/vue/vueAddResto.php";
include "$racine/vue/pied.html.php";
