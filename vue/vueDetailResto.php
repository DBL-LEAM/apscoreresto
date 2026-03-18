<h1><?= $unResto['nomR']; ?>

    <?php if ($aimer != false) { ?>
        <a href="./?action=aimer&idR=<?= $unResto['idR']; ?>"><img class="aimer" src="images/aime.png" alt="j'aime ce restaurant"></a>
    <?php } else { ?>
        <a href="./?action=aimer&idR=<?= $unResto['idR']; ?>"><img class="aimer" src="images/aimepas.png" alt="je n'aime pas encore ce restaurant"></a>
    <?php } ?>

</h1>


<div class="note-row" style="display:flex; justify-content:space-between; align-items:center; gap:12px;">
    <!-- user note (left) - clickable -->
    <div id="user-note">
        <?php for ($i = 1; $i <= 5; $i++) { ?>
            <a class="aimer" href="./?action=noter&note=<?= $i ?>&idR=<?= $unResto['idR']; ?>">
                <?php if ($i <= $note) { ?>
                    <img class="note" src="images/like.png" alt="">
                <?php } else { ?>
                    <img class="note" src="images/neutre.png" alt="line neutre">
                <?php } ?>
            </a>
        <?php } ?>
    </div>

    <!-- average note (right) - non clickable -->
    <div id="avg-note">
        <?php for ($i = 1; $i <= 5; $i++) { ?>
            <span class="aimer">
                <?php if ($i <= $noteMoy) { ?>
                    <img class="note" src="images/like.png" alt="">
                <?php } else { ?>
                    <img class="note" src="images/neutre.png" alt="line neutre">
                <?php } ?>
            </span>
        <?php } ?>
    </div>
</div>

<section>
    Cuisine <br />
    <ul id="tagFood">
        <?php for ($j = 0; $j < count($lesTypesCuisine); $j++) { ?>
            <li class="tag"><span class="tag">#</span><?= $lesTypesCuisine[$j]["libelleTC"] ?></li>
        <?php } ?>
    </ul>

</section>
<p id="principal">
    <?php if (count($lesPhotos) > 0) { ?>
        <img src="photos/<?= $lesPhotos[0]["cheminP"] ?>" alt="photo du restaurant" />
    <?php } ?>
    <br />
    <?= $unResto['descR']; ?>
</p>
<h2 id="adresse">
    Adresse
</h2>
<p>
    <?= $unResto['numAdrR']; ?>
    <?= $unResto['voieAdrR']; ?><br />
    <?= $unResto['cpR']; ?>
    <?= $unResto['villeR']; ?>

</p>

<h2 id="photos">
    Photos
</h2>
<ul id="galerie">
    <?php for ($i = 0; $i < count($lesPhotos); $i++) { ?>
        <li> <img class="galerie" src="photos/<?= $lesPhotos[$i]["cheminP"] ?>" alt="" /></li>
    <?php } ?>

</ul>

<h2 id="horaires">
    Horaires
</h2>
<div class="horaires">
    <?php
    if (!empty($unResto['horairesR'])) {
        // Convertir les sauts de ligne en <br> et afficher
        $horaires = $unResto['horairesR'];
        // Remplacer les retours à la ligne par des <br>
        $horaires = str_replace(array("\r\n", "\r", "\n"), "<br>", $horaires);
        echo $horaires;
    } else {
        echo "Horaires non disponibles";
    }
    ?>
</div>


<h2 id="crit">Critiques</h2>

<ul id="critiques">
    <?php for ($i = 0; $i < count($critiques); $i++) { ?>
        <li>
            <span>
                <?= $critiques[$i]["mailU"] ?>
                <?php if ($critiques[$i]["mailU"] == $mailU) { ?>
                    <a href='./?action=delCritique&idR=<?= $unResto['idR']; ?>'>Supprimer</a>
                <?php } ?>
            </span>
            <div>
                <span>
                    <?php
                    if ($critiques[$i]["note"]) {
                        echo $critiques[$i]["note"] . "/5";
                    }
                    ?>
                </span>
                <span><?= $critiques[$i]["commentaire"] ?> </span>
            </div>

        </li>
    <?php } ?>

</ul>
<form name="formCritique" method="post" action="./?action=critiques&idR=<?= $unResto['idR']; ?>">
    <div style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px; margin-top: 12px; margin-left: 5px;">
        <textarea name="critique" id="critiqueTextarea" placeholder="Votre critique" rows="4" style="width:895px;" maxlength="160"></textarea>
        <div style="font-size: 12px; color: #666;">
            <span id="charCount">0</span> / 160 caractères
        </div>
        <button style="" id="validerNote" data-idR="<?= $unResto['idR']; ?>">Envoyer</button>
    </div>
</form>

<script>
    const critiqueTextarea = document.getElementById('critiqueTextarea');
    const charCount = document.getElementById('charCount');

    // Initialiser le compteur au chargement
    charCount.textContent = critiqueTextarea.value.length;

    // Mettre à jour le compteur à chaque saisie
    critiqueTextarea.addEventListener('input', function() {
        charCount.textContent = this.value.length;
    });
</script>