<?php $titre = 'Latinus - ' . htmlspecialchars($profil['login']);?>


<?php ob_start() ?>
  
	<article><!--affichage des informations du profil-->
			<h3><u>Profil :</u></h3>
        	<h3><?= htmlspecialchars($profil['login']) ?></h3>
        	<h4> <?= htmlspecialchars($profil['prenom']) ?> <?= htmlspecialchars($profil['nom']) ?></h4>
        	<p>Nombre de messages : <?=htmlspecialchars($profil['nb_message']) ?></p>
        	<p>Mail : <?=htmlspecialchars($profil['email']) ?></p>
        	<p>Sexe : <?php if(htmlspecialchars($profil['sexe'])==0) {echo"Homme";} else {echo"Femme";} ?></p>
        	<p>Date de naissance : <?=htmlspecialchars($profil['date_nais']) ?></p>
        	<p>Emploi : <?=htmlspecialchars($profil['travail']) ?></p>
        	<p>Biographie :<br /> <?=nl2br(htmlspecialchars($profil['biographie'])) ?></p>
    </article>
    <br />
    <hr class="tagline-divider" />
    <br />

	<table class="table">
      <thead>
        <tr>
          <th><h3>Les derniers message de <?= htmlspecialchars($profil['login']) ?> : </h3></th>
        </tr>
      </thead>

 	  <!-- affichage des derniers commentaires-->
      <tbody>
        <?php foreach ($sujetAll as $sujet): ?>
	        <tr>
	          <td><h6> <?= htmlspecialchars($sujet['titre_categorie']) ?>  <a href="index.php?action=sujet&id=<?=$sujet['id_sujet']?>"> <?= htmlspecialchars($sujet['titre_sujet']) ?></a> - le <?= htmlspecialchars($sujet['date_sujet']) ?>
	          </h6></td>
	        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>	



	<h3 align="left"><a href="index.php">Accueil ></a></h3>

<?php $contenu = ob_get_clean();  // je met tout dans contenu?>

<?php require './vue/gabarit.php'; ?>


