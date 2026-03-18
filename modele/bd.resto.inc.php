<?php

include_once "bd.inc.php";

function getRestoByIdR($idR)
{

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from resto where idR=:idR");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);

        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}


function getRestos()
{
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from resto");
        $req->execute();

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getRestosByNomR($nomR)
{
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from resto where nomR like :nomR");
        $req->bindValue(':nomR', "%" . $nomR . "%", PDO::PARAM_STR);

        $req->execute();

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getRestosByAdresse($voieAdrR, $cpR, $villeR)
{
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from resto where voieAdrR like :voieAdrR and cpR like :cpR and villeR like :villeR");
        $req->bindValue(':voieAdrR', "%" . $voieAdrR . "%", PDO::PARAM_STR);
        $req->bindValue(':cpR', $cpR . "%", PDO::PARAM_STR);
        $req->bindValue(':villeR', "%" . $villeR . "%", PDO::PARAM_STR);
        $req->execute();

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getRestosAimesByMailU($mailU)
{
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select resto.* from resto,aimer where resto.idR = aimer.idR and mailU = :mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getRestosByTypeCuisine($tabIdTC)
{
    $resultat = array();

    // Vérifier que le tableau n'est pas vide
    if (empty($tabIdTC)) {
        return $resultat;
    }

    try {
        $cnx = connexionPDO();
        // Construire les placeholders pour la clause IN
        $placeholders = implode(',', array_fill(0, count($tabIdTC), '?'));
        $req = $cnx->prepare("select resto.* from resto, proposer where resto.idR = proposer.idR and proposer.idTC IN (" . $placeholders . ")");
        $req->execute($tabIdTC);

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}
function getRestosMulticriteres($voieAdrR, $cpR, $villeR, $tabIdTC)
{
    // Fonction destinée à la future implémentation de recherche multicritères (adresse ET/OU type de cuisine)
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM resto r WHERE r.voieAdrR like :voieAdrR and r.cpR like :cpR and r.villeR like :villeR and r.idR IN (SELECT idR FROM proposer WHERE idTC IN (" . implode(",", $tabIdTC) . "))");

        $req->bindValue(':voieAdrR', "%" . $voieAdrR . "%", PDO::PARAM_STR);
        $req->bindValue(':cpR', "%" . $cpR . "%", PDO::PARAM_STR);
        $req->bindValue(':villeR', "%" . $villeR . "%", PDO::PARAM_STR);
        $req->execute();

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getRestosTop($limit = 4)
{
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("
            SELECT r.*, AVG(c.note) as noteMoyenne 
            FROM resto r 
            LEFT JOIN critiquer c ON r.idR = c.idR 
            GROUP BY r.idR 
            ORDER BY noteMoyenne DESC, r.nomR ASC
            LIMIT :limit
        ");
        $req->bindValue(':limit', $limit, PDO::PARAM_INT);
        $req->execute();

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function addResto($nomR, $descR, $numAdrR, $voieAdrR, $cpR, $villeR, $horairesR)
{
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("insert into resto (nomR, descR, numAdrR, voieAdrR, cpR, villeR, horairesR) 
                              values(:nomR,:descR,:numAdrR,:voieAdrR,:cpR,:villeR,:horairesR)");
        $req->bindValue(':nomR', $nomR, PDO::PARAM_STR);
        $req->bindValue(':descR', $descR, PDO::PARAM_STR);
        $req->bindValue(':numAdrR', $numAdrR, PDO::PARAM_STR);
        $req->bindValue(':voieAdrR', $voieAdrR, PDO::PARAM_STR);
        $req->bindValue(':cpR', $cpR, PDO::PARAM_STR);
        $req->bindValue(':villeR', $villeR, PDO::PARAM_STR);
        $req->bindValue(':horairesR', $horairesR, PDO::PARAM_STR);
        $resultat = $req->execute();
    } catch (PDOException $e) {
        return false;
    }
    return $resultat;
}

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "getRestos() : \n";
    print_r(getRestos());

    echo "getRestoByIdR(1) : \n";
    print_r(getRestoByIdR(1));

    echo "getRestosByNomR('charcut') : \n";
    print_r(getRestosByNomR("charcut"));

    echo "getRestosByAdresse(voieAdrR, cpR, villeR) : \n";
    print_r(getRestosByAdresse("Ravel", "33000", "Bordeaux"));

    echo "getRestosAimesByMailU(mailU) : \n";
    print_r(getRestosAimesByMailU("test@bts.sio"));
}
