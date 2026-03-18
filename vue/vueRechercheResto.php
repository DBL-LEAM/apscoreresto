<h1>Recherche d'un restaurant</h1>
<form action="./?action=recherche&critere=<?= $critere ?>" method="POST">


    <?php
    switch ($critere) {
        case "nom":
    ?>
            Recherche par nom : <br />
            <input type="text" name="nomR" placeholder="nom" value="<?= $nomR ?>" /><br />
        <?php
            break;
        case "adresse":
        ?>
            Recherche par adresse : <br />
            <input type="text" name="villeR" placeholder="ville" value="<?= $villeR ?>" /><br />
            <input type="text" name="cpR" placeholder="code postal" value="<?= $cpR ?>" /><br />
            <input type="text" name="voieAdrR" placeholder="rue" value="<?= $voieAdrR ?>" /><br />
        <?php
            break;
        case "typeCuisine":
        ?>
            Recherche par type de cuisine : <br />
            <?php
            foreach ($listtypecui  as $typeCuisine) {
            ?>
                <input type="checkbox" name="tabIdTC[]" value="<?= $typeCuisine['idTC'] ?>" />
                <?= $typeCuisine['libelleTC'] ?><br />
            <?php
            }
            break;
        case "multicriteres":
            ?>
            Recherche multicritères : <br />
            <input type="text" name="villeR" placeholder="ville" value="<?= $villeR ?>" /><br />
            <input type="text" name="cpR" placeholder="code postal" value="<?= $cpR ?>" /><br />
            <input type="text" name="voieAdrR" placeholder="rue" value="<?= $voieAdrR ?>" /><br />
            <br />
            Types de cuisine : <br />
            <?php
            foreach ($listtypecui  as $typeCuisine) {
            ?>
                <input type="checkbox" name="tabIdTC[]" value="<?= $typeCuisine['idTC'] ?>" />
                <?= $typeCuisine['libelleTC'] ?><br />
    <?php
            }
            break;
    }
    ?>
    <br /><br />
    <input type="submit" value="Rechercher" />

</form>