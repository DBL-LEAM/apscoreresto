<h1>Ajouter un restaurant</h1>

<?php if ($msg != "") : ?>
        <span style="color: <?php echo $ajoutSuccess ? 'green' : 'red'; ?>;"><?= $msg ?></span>
<?php endif; ?>

<?php if (!$ajoutSuccess) : ?>
    <form action="./?action=ajouterResto" method="POST">
        <label for="nomR">Nom du restaurant :</label> <br />
        <input type="text" id="nomR" name="nomR" placeholder="Nom du restaurant" required /><br />

        <label for="descR">Description :</label> <br />
        <textarea id="descR" name="descR" placeholder="Description du restaurant" rows="4" cols="50"></textarea><br />

        <label for="numAdrR">Numéro :</label> <br />
        <input type="text" id="numAdrR" name="numAdrR" placeholder="Numéro" /><br />

        <label for="voieAdrR">Rue :</label> <br />
        <input type="text" id="voieAdrR" name="voieAdrR" placeholder="Rue" required /><br />

        <label for="cpR">Code postal :</label> <br />
        <input type="text" id="cpR" name="cpR" placeholder="Code postal" required /><br />

        <label for="villeR">Ville :</label> <br />
        <input type="text" id="villeR" name="villeR" placeholder="Ville" required /><br />

        <label for="horairesR">Horaires d'ouverture :</label> <br />
        
        <label for="lundi">Lundi :</label> <br />
        <input type="text" id="lundi" name="lundi" placeholder="ex: 11h30-14h00, 18h30-22h00" /><br />
        
        <label for="mardi">Mardi :</label> <br />
        <input type="text" id="mardi" name="mardi" placeholder="ex: 11h30-14h00, 18h30-22h00" /><br />
        
        <label for="mercredi">Mercredi :</label> <br />
        <input type="text" id="mercredi" name="mercredi" placeholder="ex: 11h30-14h00, 18h30-22h00" /><br />
        
        <label for="jeudi">Jeudi :</label> <br />
        <input type="text" id="jeudi" name="jeudi" placeholder="ex: 11h30-14h00, 18h30-22h00" /><br />
        
        <label for="vendredi">Vendredi :</label> <br />
        <input type="text" id="vendredi" name="vendredi" placeholder="ex: 11h30-14h00, 18h30-22h00" /><br />
        
        <label for="samedi">Samedi :</label> <br />
        <input type="text" id="samedi" name="samedi" placeholder="ex: 11h30-14h00, 18h30-22h00" /><br />
        
        <label for="dimanche">Dimanche :</label> <br />
        <input type="text" id="dimanche" name="dimanche" placeholder="ex: 11h30-14h00, 18h30-22h00" /><br />

        <input type="submit" value="Ajouter" />
    </form>
<?php endif; ?>