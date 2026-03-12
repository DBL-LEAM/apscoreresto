<?php
include_once "$racine/modele/bd.critiquer.inc.php";
include_once "$racine/modele/authentification.inc.php";

$mailU = getMailULoggedOn();
$note = $_GET['note'];
$idR = $_GET['idR'];

if (isLoggedOn()) {
    var_dump(1);
    addOrUpdateCritique($idR, $mailU, $note, null);
}

header("Location: " . $_SERVER["HTTP_REFERER"]);