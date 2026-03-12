<?php
include_once "$racine/modele/bd.critiquer.inc.php";
include_once "$racine/modele/authentification.inc.php";

$idR = $_GET['idR'];
$mailU = getMailULoggedOn();

if (isset($mailU)) {
    deleteCritiqueByUser($idR, $mailU);
    }

header("Location: " . $_SERVER["HTTP_REFERER"]);