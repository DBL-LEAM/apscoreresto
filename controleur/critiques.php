<?php
include_once "$racine/modele/bd.critiquer.inc.php";
include_once "$racine/modele/authentification.inc.php";

$idR = $_GET['idR'];
$mailU = getMailULoggedOn();

if (isset($mailU)) {
    if (!empty(trim($_POST['critique']))) {
        $critiqueU = $_POST['critique'];
        if (strlen($critiqueU) <= 160) {
            addOrUpdateCritique(idR : $idR, mailU : $mailU, note : null, commentaire : $critiqueU);
        } else {
            $_SESSION['message'] = 'Le champ de critique ne peut pas dépasser 160 caractères.';
        }
    }
}


header("Location: " . $_SERVER["HTTP_REFERER"]);