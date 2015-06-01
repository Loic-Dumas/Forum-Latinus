
<?php $titre = 'Forum Latinus'; ?>

<?php ob_start() ?>

<p>Une erreur est survenue : <?= $msgErreur ?></p>
<p>
    <img src="./business-casual/img/erreur.gif" alt="Erreur" />
</p>
<?php $contenu = ob_get_clean(); ?>

<?php require './vue/gabarit.php'; ?>