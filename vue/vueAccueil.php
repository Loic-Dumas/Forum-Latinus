
<?php $titre = 'Forum Latinus'; ?>

<?php ob_start(); ?>
	<?php foreach ($categorieAll as $categorie): ?>
		 	<!--affichage de la catégorie-->
				<h2 class="categorie"><a href="<?= "index.php?action=categorie&id=" . $categorie['id_categorie'] ?>"><?= nl2br(htmlspecialchars($categorie['titre'])) ?></a> </h2>
			
				<p class="categorie"><?= nl2br(htmlspecialchars($categorie['description'])) ?></p>
				<br />
				<hr class="tagline-divider" />
	<?php endforeach; ?>
<?php $contenu = ob_get_clean(); ?>

<?php require './vue/gabarit.php'; ?>
