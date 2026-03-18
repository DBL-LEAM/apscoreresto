<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";
include_once "$racine/modele/bd.critiquer.inc.php";

// Vérifier que l'utilisateur est modérateur
if (isLoggedOn()) {
    $mailU = getMailULoggedOn();
    $util = getUtilisateurByMailU($mailU);

    // Vérifier si l'utilisateur est modérateur
    if (isset($util["role"]) && $util["role"] == "moderateur") {
        // Récupérer l'ID du restaurant et le mail de l'utilisateur
        if (isset($_GET["idR"]) && isset($_GET["mailU"])) {
            $idR = $_GET["idR"];
            $mailUAuteur = $_GET["mailU"];

            // Décliner la critique en la supprimant
            $ret = declinerCritique($idR, $mailUAuteur);
            if ($ret) {
                $_SESSION["message"] = "La critique a été déclinée.";
            } else {
                $_SESSION["message"] = "Une erreur est survenue lors du déclin de la critique.";
            }
        }
    }
}

header("Location: " . $_SERVER["HTTP_REFERER"]);
exit();
