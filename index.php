
<?php

require('./controleur/controleur.php');

try {

  // les GET :

  if (isset($_GET['action'])) {

    //si c'est une catégorie
    if ($_GET['action'] == 'categorie') {
      if (isset($_GET['id'])) {
        $idCategorie = intval($_GET['id']);
        if ($idCategorie > 0){
          $page = 1 ;
          if (isset($_GET['page'])) {
            $page = intval($_GET['page']);
            if ($page  < 1){
              $page = 1;
            }
          }
          categorie($idCategorie, $page);

        }
        else
          throw new Exception("Identifiant de categorie non valide");
      }
      else
        throw new Exception("Identifiant de categorie non défini");
    }


    //si c'est un sujet
    elseif ($_GET['action'] == 'sujet') {
      if (isset($_GET['id'])) {
        $idSujet = intval($_GET['id']);
        if ($idSujet > 0){
          $page = 1 ;
          if (isset($_GET['page'])) {
            $page = intval($_GET['page']);
            if ($page  < 1){
              $page = 1;
            }
          }
          sujet($idSujet, $page);
        }
        else
          throw new Exception("Identifiant de sujet non valide");
      }
      else
        throw new Exception("Identifiant de sujet non défini");
    }

    //si c'est un profil
    elseif ($_GET['action'] == 'profil') {
      if (isset($_GET['id'])) {
        $idProfil = intval($_GET['id']);
        if ($idProfil > 0)
          profil($idProfil);
        else
          throw new Exception("Identifiant de profil non valide");
      }
      else
        throw new Exception("Identifiant de prodil non défini");
    }


    else // fin des actions possibles -> url non valide
      throw new Exception("Action non valide");
    }// fin de s'il y a une action



  //Les POST :

  //si on a reçu un post d'ajout de sujet pour une catégorie
  else if (isset($_POST['id_categorie'])){

      if (isset($_POST['id_profil']) AND isset($_POST['titre']) AND isset($_POST['contenu'])){
      echo "Les lamas c'est la vie";

      nouveauSujet($_POST['id_categorie'], $_POST['id_profil'], $_POST['titre'], $_POST['contenu']);
      //le nouveau sujet est bien inséré, on peut afficher le début de catégorie
      categorie($_POST['id_categorie'], 1);
      }
      else{
        throw new Exception("Tous les champs ne sont pas remplies.");
      }

  }

  //si on a reçu un post de commentaire pour un sujet
  else if (isset($_POST['id_sujet'])){

      if (isset($_POST['auteur']) AND isset($_POST['email']) AND isset($_POST['titre']) AND isset($_POST['contenu']) AND  isset($_POST['page'])){
      echo "Les lamas c'est la vie !";

      nouveauCommentaire($_POST['id_sujet'], $_POST['auteur'], $_POST['email'], $_POST['titre'], $_POST['contenu']);
      //le nouveau commentaire est bien inséré, on peut afficher la page dernière page
      sujet($_POST['id_sujet'], $_POST['page']);

      }
      else{
        throw new Exception("Tous les champs ne sont pas remplies.");
      }

  }

  //pour supprimer un sujet
  else if (isset($_POST['supp_id_sujet']) AND isset($_POST['categorie_du_sujet'])) {
      echo "Les lamas c'est la vie !";
      supprimerSujet($_POST['supp_id_sujet']);
      //le sujet a bien été supprimé, retour sur la catégorie correspodante

      categorie($_POST['categorie_du_sujet'], 1);
  }

  //pour supprimer un commentaire
  else if (isset($_POST['supp_id_commentaire']) AND isset($_POST['sujet_du_commentaire'])) {
      echo "Les lamas c'est la vie !";
      supprimerCommentaire($_POST['supp_id_commentaire']);
      //le sujet a bien été supprimé, retour sur la catégorie correspodante

      sujet($_POST['sujet_du_commentaire'], $_POST['page']);
  }



  // Si aucune ction particulière, on arrive sur l'accueil 
  else {
    accueil();  // action par défaut
    }
  } 

  // on récupére sinon les erreurs
catch (Exception $e) {
    erreur($e->getMessage());
}