<?php

require './modele/modele.php';

// Affiche la liste de toutes les catégories du forum
function accueil(){
  $categorieAll = getCategorieAll();
  require './vue/vueAccueil.php';
}

// Affiche une catégorie et ses sujets
function categorie($idCategorie, $page){
  $categorie = getCategorie($idCategorie);
  $pageMax = getpageMaxSujet($idCategorie, 20);
  if ($pageMax < $page) {
  	$page = $pageMax;
  }
  $sujetAll = getSujetPage($idCategorie, 20, $page);
  require './vue/vueCategorie.php';
}


// Affiche une catégorie et ses sujets
function sujet($idSujet, $page){
  $sujet = getSujetProfil($idSujet);//récupére le sujet et le profil
  $titreCategorie = getTitreCategorie($idSujet); //récupére le titre et id de la catégorie
  $pageMax = getpageMaxCommentaire($idSujet, 10);
  if ($pageMax < $page) {
  	$page = $pageMax;
  }
  $commentaireAll = getCommentairePage($idSujet, 10, $page); // récupére les commentaires
  require './vue/vueSujet.php';
}


// Affiche un profil et ses derniers sujets
function profil($idProfil){
	$profil = getProfil($idProfil);
	$sujetAll = getSujetDe($idProfil);
	require './vue/vueProfil.php';
}


//insert un nouveau sujet
function nouveauSujet($id_categorie, $id_profil, $titre, $contenu){
  postSujet($id_categorie, $id_profil, $titre, $contenu);
}

// supprime un sujet
function supprimerSujet($id_sujet){
  deleteSujet($id_sujet);
}

//insert un nouveau commentaire
function nouveauCommentaire($id_sujet, $auteur, $email, $titre, $contenu){
  postCommentaire($id_sujet, $auteur, $email, $titre, $contenu);
}

// supprime un sujet
function supprimerCommentaire($id_commentaire){
  deleteCommentaire($id_commentaire);
}



// Affiche une erreur
function erreur($msgErreur){
  require './vue/vueErreur.php';
}



