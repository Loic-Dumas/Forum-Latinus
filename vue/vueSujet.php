
<?php $titre = 'Latinus  - ' . htmlspecialchars($sujet['titre']);?>


<?php ob_start() ?>
  <?php if (isset($_POST['supp_id_commentaire'])) {// pour valider l'insertion d'un sujet ?>
    <hr />
    <h4> Commentaire bien supprimé ! </h4>
    <hr />
<?php } ?>
<?php if (isset($_POST['id_sujet'])) { // pour valider l'insertion d'un sujet?>
  <hr />
  <h4> commentaire bien inséré ! </h4>
  <hr />
<?php } ?>



  
  <div class="bs-example" data-example-id="simple-table">
    <table class="table" >
      <thead>
        <tr>
          <th width=20%><h4>Auteur</h4></th>
          <th width=80%><h4>Sujet</h4></th>
        </tr>
      </thead>
      <tbody>
		<!--affichage du sujet -->
		<tr class="info">
	      <td width=20%>
	      	<div >
	      	  
	          	Auteur : <a href="<?= "index.php?action=profil&id=" . $sujet['id_profil'] ?>"><?= stripcslashes(htmlspecialchars($sujet['login']))  ?></a><br />
	          	Nombre de message : <?= stripcslashes(htmlspecialchars($sujet['nb_message'])) ?><br />
	          	Age : <?= htmlspecialchars($sujet['age']) ?><br />
	          	Sexe : <?php if(htmlspecialchars($sujet['sexe'])==0) {echo"Homme";} else {echo"Femme";} ?><br />
	          	Fonction : <?= htmlspecialchars($sujet['travail']) ?>
	          
	        </div>
          </td>

          <td width=80%>   
          	<h4><b><?= htmlspecialchars(($sujet['titre'])) ?></b></h4>
          	<p><?= stripcslashes(nl2br(htmlspecialchars($sujet['contenu']))) ?></p>
          	<div align="right">
              <form method="post" action="./index.php"> 
                <input type="hidden" name="supp_id_sujet" value="<?= $sujet['id_sujet'] ?>" />
                <input type="hidden" name="categorie_du_sujet" value="<?= $titreCategorie['id_categorie'] ?>" />
                <input class="boutonlien" type="submit" value="supprimer le sujet" /> 
              </form> 
              <?= htmlspecialchars($sujet['date_sujet']) ?> 
            </div>
          </td>
        </tr>

        <!--affichage des commentaires -->
        <?php foreach ($commentaireAll as $commentaire): ?>
        <tr>
          <td width=20%>
          	<div >
	          	Auteur : <?= htmlspecialchars($commentaire['auteur']) ?><br />
	          	Email : <?= htmlspecialchars($commentaire['email']) ?>
          	</div>
          </td>

          <td width=80%> 
          	<h4><b><?= htmlspecialchars($commentaire['titre']) ?></b></h4>
          	<p><?= nl2br(htmlspecialchars($commentaire['contenu'])) ?></p>
          	<div align="right">
              <form method="post" action="./index.php"> 
                <input type="hidden" name="sujet_du_commentaire" value="<?= $sujet['id_sujet'] ?>" />
                <input type="hidden" name="page" value="<?= $page ?>" />
                <input type="hidden" name="supp_id_commentaire" value="<?= $commentaire['id_commentaire'] ?>" />
                <input class="boutonlien" type="submit" value="effacer de commentaire" /> 
              </form> 
              <?= htmlspecialchars($commentaire['date_commentaire']) ?>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
      
    </table>
  </div>
  <!-- /fin du tableau -->




<hr />
<h3> Nouveau Commentaire : </h3>
<!--formulaire-->
<form method="post" action="./index.php">
	<input type="hidden" name="id_sujet" value="<?= $sujet['id_sujet'] ?>" />
	<input type="hidden" name="page" value="<?= ($pageMax) ?>" />
    <input id="auteur" name="auteur" type="text" placeholder="Pseudo" required class="form-control"/><br />
    <input id="email" name="email" type="email" placeholder="Email" required class="form-control"/><br />
    <input id="titre" name="titre" type="text" placeholder="Titre" required class="form-control"/><br />
    <textarea id="contenu" name="contenu" placeholder="Votre commentaire" required class="form-control"></textarea>
    <br />
    <button type="submit" class="btn btn-primary">Publier</button>
</form>
<!--fin du formulaire-->


<hr />
<!-- Pagination -->
<p align="right">
<?php if ($page > 1) {?> 
	<a href="<?= "index.php?action=sujet&id=" . $sujet['id_sujet'] . "&page=1" ?>"> Début</a> - 
	<a href="<?= "index.php?action=sujet&id=" . $sujet['id_sujet'] . "&page=" . ($page-1) ?>"> Précedent</a> -
<?php } ?> 

Page <?= $page ?> / <?= $pageMax ?> 

<?php if ($page < $pageMax) { ?>
	- <a href="<?= "index.php?action=sujet&id=" . $sujet['id_sujet'] . "&page=" . ($page+1) ?>"> Suivant</a> - 
	<a href="<?= "index.php?action=sujet&id=" . $sujet['id_sujet'] . "&page=" . $pageMax ?>"> Dernier</a>
<?php } ?> 
</p>
<!-- Fin Pagination -->







	<h3 align="left"><a href="index.php">Accueil</a> > <a href="<?= "index.php?action=categorie&id=" . $titreCategorie['id_categorie'] ?>"> <?= htmlspecialchars($titreCategorie['titre']) ?></a> > 
		<a href="<?= "index.php?action=sujet&id=" . $sujet['id_sujet'] ?>"> <?= htmlspecialchars($sujet['titre']) ?></a></h3>

<?php $contenu = ob_get_clean();  // je met tout dans contenu?>
<?php require './vue/gabarit.php'; ?>


