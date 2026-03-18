<h1>Top 4 des restaurants</h1>

<?php
for ($i = 0; $i < count($listeRestos); $i++) {

    $lesPhotos = getPhotosByIdR($listeRestos[$i]['idR']);
    $noteMoyenne = $listeRestos[$i]['noteMoyenne'];
?>

    <div class="card">
        <div class="photoCard">
            <?php if (count($lesPhotos) > 0) { ?>
                <img src="photos/<?= $lesPhotos[0]["cheminP"] ?>" alt="photo du restaurant" />
            <?php } ?>


        </div>
        <div class="descrCard"><?php echo "<a href='./?action=detail&idR=" . $listeRestos[$i]['idR'] . "'>" . $listeRestos[$i]['nomR'] . "</a>"; ?>
            <br />
            <?= $listeRestos[$i]["numAdrR"] ?>
            <?= $listeRestos[$i]["voieAdrR"] ?>
            <br />
            <?= $listeRestos[$i]["cpR"] ?>
            <?= $listeRestos[$i]["villeR"] ?>
            <br />
            <?php if ($noteMoyenne !== null) { ?>
                Note moyenne : <?= number_format($noteMoyenne, 2) ?>/5
            <?php } else { ?>
                Pas encore de notes
            <?php } ?>
        </div>
        <div class="tagCard">
            <ul id="tagFood">


            </ul>


        </div>

    </div>





<?php
}
?>