<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";
include_once "$racine/modele/bd.critiquer.inc.php";

if (isLoggedOn()) {
    $mailU = getMailULoggedOn();
    $util = getUtilisateurByMailU($mailU);

    if (isset($util["role"]) && $util["role"] == "moderateur") {
        if (isset($_GET["idR"]) && isset($_GET["mailU"])) {
            $idR = $_GET["idR"];
            $mailUAuteur = $_GET["mailU"];

            $ret = autoriserCritique($idR, $mailUAuteur);
            if ($ret) {
                $_SESSION["message"] = "La critique a été autorisée.";
            } else {
                $_SESSION["message"] = "Une erreur est survenue lors de l'autorisation de la critique.";
            }
        }
    }
}

header("Location: " . $_SERVER["HTTP_REFERER"]);
exit();
