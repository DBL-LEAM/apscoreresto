<h1>Mon profil</h1>

Mon adresse électronique : <?= $util["mailU"] ?> <br />
Mon pseudo : <?= $util["pseudoU"] ?> <br />

<?php if ($estModerateur) : ?>
    <strong>Rôle : Modérateur</strong> <br />
<?php endif; ?>

<hr>

<h3>Les restaurants que j'aime :</h3>
<?php if (count($mesRestosAimes) === 0) : ?>
    <p>Aucun restaurant aimé.</p>
<?php else: ?>
    <?php for ($i = 0; $i < count($mesRestosAimes); $i++) { ?>
        <a href="./?action=detail&idR=<?= $mesRestosAimes[$i]["idR"] ?>"><?= htmlspecialchars($mesRestosAimes[$i]["nomR"]) ?></a><br />
    <?php } ?>
<?php endif; ?>
<hr>
les types de cuisine que j'aime :
<ul id="tagFood">
    <?php for ($i = 0; $i < count($mesTypeCuisineAimes); $i++) { ?>
        <li class="tag"><span class="tag">#</span><?= htmlspecialchars($mesTypeCuisineAimes[$i]["libelleTC"]) ?></li>
    <?php } ?>
</ul>

<?php if ($estModerateur) : ?>
    <hr>
    <h3>Fonctionnalités modérateur :</h3>
    <ul>
        <li><a href="./?action=ajouterResto">Ajouter un restaurant</a></li>
        <li><a href="./?action=gererCritiques">Gérer les critiques</a></li>
    </ul>
<?php endif; ?>

<hr>

<a href="./?action=deconnexion">se deconnecter</a>