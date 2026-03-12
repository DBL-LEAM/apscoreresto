<?php
if ($_SERVER['SCRIPT_FILENAME'] == __FILE__) {
    $racine = '..';
}

include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";
include_once "$racine/modele/bd.typecuisine.inc.php";
include_once "$racine/modele/bd.resto.inc.php";
include_once "$racine/modele/bd.aimer.inc.php";

// menu simple
$menuBurger = [['url' => './?action=profil', 'label' => 'Consulter mon profil'], ['url' => './?action=updProfil', 'label' => 'Modifier mon profil']];

if (!isLoggedOn()) {
    $titre = 'Mon profil';
    include "$racine/vue/entete.html.php";
    include "$racine/vue/pied.html.php";
    exit;
}

$mailU = getMailULoggedOn();

$message = '';
$logoutAfterUpdate = false;
$mesRestosAimes = getRestosAimesByMailU($mailU);
$mesTypeCuisineAimes = getTypesCuisinePreferesByMailU($mailU);
$allTypes = getTypesCuisine();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if (!empty($_POST['pseudo'])) {
        $pseudo = ($_POST['pseudo']);
        if (preg_match('/^[\p{L}]+$/u', $pseudo)) {
            if (updatePseudoByMailU($mailU, $pseudo)) $message .= 'Pseudo mis à jour. ';
            else $message .= 'Erreur lors de la mise à jour du pseudo. ';
        } else $message .= 'Le pseudo doit contenir seulement des lettres. ';
    }


    if (isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['new_password_confirm'])) {
        $old = $_POST['old_password'];
        $new = $_POST['new_password'];
        $confirm = $_POST['new_password_confirm'];
        $util = getUtilisateurByMailU($mailU);
        if ($old === '' || $new === '' || $confirm === '') {
            $message .= 'Veuillez remplir tous les champs du mot de passe. ';
        } else {
            if (!password_verify($old, $util['mdpU'])) {
                $message .= 'Ancien mot de passe incorrect. ';
            } elseif ($new !== $confirm) {
                $message .= 'Le nouveau mot de passe et sa confirmation ne correspondent pas. ';
            } elseif (password_verify($new, $util['mdpU'])) {
                $message .= 'Le nouveau mot de passe doit être différent de l\'ancien. ';
            } elseif (strlen($new) < 6) {
                $message .= 'Le nouveau mot de passe doit contenir au moins 6 caractères. ';
            } else {
                if (updateMdpByMailU($mailU, $new)) {
                    $message .= 'Mot de passe modifié avec succès. Vous serez déconnecté(e) sous peu. ';
                    logout();
                    session_destroy();
                    header("Refresh:3; url=./?action=deconnexion");
                } else $message .= 'Erreur lors de la mise à jour du mot de passe. ';
            }
        }
    }

    if ($action === 'updateTypes') {
        $mesTypeCuisineAimes = getTypesCuisinePreferesByMailU($mailU);
        $selected = [];
        if (!empty($_POST['types']) && is_array($_POST['types'])) {
            foreach ($_POST['types'] as $v) $selected[] = intval($v);
        }
        $current = [];
        foreach ($mesTypeCuisineAimes as $t) $current[] = intval($t['idTC']);
        foreach ($selected as $idTC) if (!in_array($idTC, $current)) addPreferer($mailU, $idTC);
        foreach ($current as $idTC) if (!in_array($idTC, $selected)) delPreferer($mailU, $idTC);
        $message .= 'Préférences mises à jour. ';
    }

    if ($action === 'delAimer' && isset($_POST['idR'])) {
        $idR = intval($_POST['idR']);
        if (delAimer($mailU, $idR)) $message .= 'Restaurant supprimé de vos favoris. ';
        else $message .= 'Impossible de supprimer le restaurant aimé. ';
    }

    $mesRestosAimes = getRestosAimesByMailU($mailU);
    $mesTypeCuisineAimes = getTypesCuisinePreferesByMailU($mailU);
    $allTypes = getTypesCuisine();
}

$titre = 'Mon profil';
include "$racine/vue/entete.html.php";
include "$racine/vue/vueUpdateProfil.php";
include "$racine/vue/pied.html.php";
