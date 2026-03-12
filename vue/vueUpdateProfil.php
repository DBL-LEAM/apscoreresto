<h1 style="margin-bottom: 40px;">Infos de mon profil</h1>

<?php if (!empty($message)) : ?>
  <p style="color: green; font-weight: bold;"><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>

<?php if (!empty($logoutAfterUpdate)) : ?>
  <p style="color: green; font-weight: bold;">Mise à jour effectuée. Vous serez déconnecté. <a href="./?action=deconnexion">Se déconnecter maintenant</a></p>
<?php endif; ?>

<form method="post" action="">
  <h2 style="font-size: 18px;">Modifier mon pseudonyme: (seul les caractères alphabétiques sont autorisés)</h2>
  <input type="text" name="pseudo" pattern="[A-Za-zÀ-ÖØ-öø-ÿ]+" title="Lettres uniquement (accents autorisés)" value=""> <br><br>
  <hr>

  <h3 style="font-size: 18px;">Modifier mon mot de passe</h3>
  <div style="display: flex; flex-direction: column; gap: 8px; max-width: 360px;">
    <input type="password" name="old_password" placeholder="Ancien mot de passe" />
    <input type="password" name="new_password" placeholder="Nouveau mot de passe" />
    <input type="password" name="new_password_confirm" placeholder="Répétez le nouveau mot de passe" />
  </div>

  <div style="margin-top: 12px;">
    <button type="submit">Envoyer</button>
  </div>
</form>


<h3>Les restaurants que j'aime :</h3>
<?php
  if (!isset($mesRestosAimes) || !is_array($mesRestosAimes)) {
    $mesRestosAimes = array();
  }
  if (!isset($mesTypeCuisineAimes) || !is_array($mesTypeCuisineAimes)) {
    $mesTypeCuisineAimes = array();
  }
  if (!isset($allTypes) || !is_array($allTypes)) {
    $allTypes = array();
  }
?>

<?php if (count($mesRestosAimes) === 0) : ?>
  <p>Aucun restaurant aimé.</p>
<?php else: ?>
  <?php for ($i = 0; $i < count($mesRestosAimes); $i++) { ?>
    <div>
      <a href="./?action=detail&idR=<?= $mesRestosAimes[$i]["idR"] ?>"><?= htmlspecialchars($mesRestosAimes[$i]["nomR"]) ?></a>
      <form method="post" action="" style="display:inline; margin-left:8px;">
        <input type="hidden" name="action" value="delAimer">
        <input type="hidden" name="idR" value="<?= intval($mesRestosAimes[$i]["idR"]) ?>">
        <button type="submit">Supprimer</button>
      </form>
    </div>
  <?php } ?>
<?php endif; ?>
<hr>
<h4>Gérer mes types de cuisine préférés</h4>
<form method="post" action="">
  <input type="hidden" name="action" value="updateTypes">
  <div style="display:flex; flex-direction:column; gap:6px; max-width:480px;">
    <?php
    $prefIds = array();
    foreach ($mesTypeCuisineAimes as $t) {
      $prefIds[intval($t['idTC'])] = true;
    }
    foreach ($allTypes as $t) :
      $id = intval($t['idTC']);
      $checked = isset($prefIds[$id]) ? 'checked' : '';
    ?>
      <label style="display:flex; align-items:center; gap:8px;">
        <input type="checkbox" name="types[]" value="<?= $id ?>" <?= $checked ?>> <?= htmlspecialchars($t['libelleTC']) ?>
      </label>
    <?php endforeach; ?>
  </div>
  <div style="margin-top:8px;"><button type="submit">Mettre à jour mes préférences</button></div>
</form>

<hr>