<?php

include_once "bd.inc.php";

function getCritiquerByIdR($idR)
{
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from critiquer where idR=:idR");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);

        $req->execute();

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getNoteMoyenneByIdR($idR)
{

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select avg(note) from critiquer where idR=:idR");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);

        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    if ($req->rowCount() > 0) {
        return $resultat["avg(note)"];
    } else {
        return 0;
    }
}

function getNoteByUser($idR, $mailU)
{

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT note FROM critiquer WHERE idR=:idR AND mailU=:mailU");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);

        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    if ($req->rowCount() > 0) {
        return $resultat["note"];
    } else {
        return null;
    }
}


function addOrUpdateCritique($idR, $mailU, $note = null, $commentaire = null)
{
    try {
        $cnx = connexionPDO();
        // si l'utilisateur a déjà une critique on la met à jour  sinon on insère
        $req = $cnx->prepare("
            INSERT INTO critiquer (idR, mailU, note, commentaire)
            VALUES (:idR,:mailU,:note,:commentaire)
            ON DUPLICATE KEY UPDATE
            note = if(:note IS NOT NULL,:note, note),
            commentaire = if(:commentaire IS NOT NULL, :commentaire, commentaire)
            
        ");
        // ON DUPLICATE KEY sert à mettre à jour une ligne si une clé unique existe déjà dans un INSERT. methode utilisée au lieu de faire une requête plus longue
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->bindValue(':commentaire', $commentaire, PDO::PARAM_STR);
        $req->bindValue(':note', $note, PDO::PARAM_INT);
        return $req->execute();
    } catch (PDOException $e) {
        return false;
    }
}

function deleteCritiqueByUser($idR, $mailU)
{
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("DELETE FROM critiquer WHERE idR = :idR AND mailU = :mailU");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        return $req->execute();
    } catch (PDOException $e) {
        return false;
    }
}



if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "\n getCritiquerByIdR(1) : \n";
    print_r(getCritiquerByIdR(1));

    echo "\n getNoteMoyenneByIdR(1) : \n";
    print_r(getNoteMoyenneByIdR(1));
}
