<h1>Gérer les critiques</h1>

<?php if (count($critiquesEnAttente) === 0) : ?>
    <p>Aucune critique en attente.</p>
<?php else: ?>
    <table border="1">
        <tr>
            <th>Restaurant</th>
            <th>Auteur</th>
            <th>Note</th>
            <th>Commentaire</th>
            <th>Actions</th>
        </tr>
        <?php for ($i = 0; $i < count($critiquesEnAttente); $i++) {
            $unResto = getRestoByIdR($critiquesEnAttente[$i]["idR"]);
        ?>
            <tr>
                <td><?= htmlspecialchars($unResto["nomR"]) ?></td>
                <td><?= htmlspecialchars($critiquesEnAttente[$i]["mailU"]) ?></td>
                <td><?= $critiquesEnAttente[$i]["note"] != null ? $critiquesEnAttente[$i]["note"] . "/5" : "Pas de note" ?></td>
                <td><?= htmlspecialchars($critiquesEnAttente[$i]["commentaire"]) ?></td>
                <td>
                    <a href="./?action=autoriserCritique&idR=<?= $critiquesEnAttente[$i]["idR"] ?>&mailU=<?= $critiquesEnAttente[$i]["mailU"] ?>">Autoriser</a> |
                    <a href="./?action=declinerCritique&idR=<?= $critiquesEnAttente[$i]["idR"] ?>&mailU=<?= $critiquesEnAttente[$i]["mailU"] ?>">Décliner</a>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php endif; ?>

<hr>

<a href="./?action=profil">Retour au profil</a>