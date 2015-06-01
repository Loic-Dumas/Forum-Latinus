
<?php $titre = 'Latinus - ' . htmlspecialchars($categorie['titre']);?>


<?php ob_start() ?>

 <?php if (isset($_POST['supp_id_sujet'])) { // pour valider la suppression d'un sujet?>
    <hr />
    <h4> Sujet bien supprimé ! </h4>
    <hr />
<?php } ?>


<?php if (isset($_POST['id_categorie'])) { // pour valider l'insertion d'un sujet?>
  <hr />
  <h4> Sujet bien inséré ! </h4>
  <hr />
<?php } ?>


    <table class="table"> <!--affichage des sujets-->
      <thead>
        <tr>
          <th width=85%><h4><?= htmlspecialchars($categorie['titre']) ?></h4></th>
          <th width=15% align="center"><h4>Réponses</h4></th>
        </tr>
      </thead>
      <?php foreach ($sujetAll as $sujet): ?>
      <tbody>
        <tr>
          <td width=85%> <a href="<?= "index.php?action=sujet&id=" . $sujet['id_sujet'] ?>">  <b><?= (htmlspecialchars($sujet['titre'])) ?></b></a><br />
          	Par : <a href="<?= "index.php?action=profil&id=" . $sujet['id_profil'] ?>"><?= htmlspecialchars($sujet['login']) ?></a> - <?= htmlspecialchars($sujet['date_sujet']) ?> </td>
          <td width=15% align="center"><?= htmlspecialchars($sujet['nb_reponse']) ?></td>
        </tr>
      </tbody>
      <?php endforeach; ?>
    </table>	

<hr />

<!--formulaire-->
<h3> Nouveau Sujet : </h3>
<form method="post" action="./index.php">
	<input type="hidden" name="id_categorie" value="<?= $categorie['id_categorie'] ?>" />
    <input id="id_profil" name="id_profil" type="text" placeholder="Votre pseudo(numéro)" class="form-control" required/><br />
    <input id="titre" name="titre" type="text" placeholder="Titre" class="form-control" required /><br />

    <textarea id="contenu" name="contenu" placeholder="Texte de votre sujet." class="form-control" required> </textarea>
    <button type="submit" class="btn btn-primary">Publier</button>
</form>
<!-- Fin Formulaire -->



<!-- Pagination -->
<p align="right">
<?php if ($page > 1) {?> 
	<a href="<?= "index.php?action=categorie&id=" . $categorie['id_categorie'] . "&page=1" ?>"> Début</a> - 
	<a href="<?= "index.php?action=categorie&id=" . $categorie['id_categorie'] . "&page=" . ($page-1) ?>"> Précedent</a> - 
<?php } ?> 

Page <?= $page ?> / <?= $pageMax ?>

<?php if ($page < $pageMax) { ?>
	 - <a href="<?= "index.php?action=categorie&id=" . $categorie['id_categorie'] . "&page=" . ($page+1) ?>"> Suivant</a> - 
	<a href="<?= "index.php?action=categorie&id=" . $categorie['id_categorie'] . "&page=" . $pageMax ?>"> Dernier</a>
<?php } ?> 
</p>
<!-- Fin Pagination -->


	<h3 align="left"><a href="index.php">Accueil</a> > <a href="<?= "index.php?action=categorie&id=" . $categorie['id_categorie'] ?>"> <?= htmlspecialchars($categorie['titre']) ?> </a>  </h3>


<?php $contenu = ob_get_clean();  // je met tout dans contenu?>
<?php require './vue/gabarit.php'; ?>


