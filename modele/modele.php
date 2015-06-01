<?php
//accueil
function getCategorieAll(){
	$db = getDb();
	$reponse = $db->query('SELECT * FROM categorie ORDER BY id_categorie');
	return $reponse->fetchAll();
}



//catégorie : retourne les infos de la catégorie passé en id
function getCategorie($idCategorie){
	$db = getDb();
	$reponse = $db->prepare('SELECT * FROM categorie WHERE id_categorie = ?;');
	$reponse->execute(array($idCategorie));

	if($reponse->rowCount() ==1){
		return $reponse->fetch(); //on renvoie la première ligne du résultat
	}
	else 
		throw new Exception("Aucune categorie ne correspond à l'identifiant '$idCategorie'");
	return $reponse;
}

//catégorie : retourne les $nombre derniers sujets à la page $page
function getSujetPage($idCategorie, $nombre, $page){
	$db = getDb();
	$debut = $nombre * ($page-1); // du i eme sujet
	$reponse = $db->prepare('SELECT s.id_sujet as id_sujet, s.id_profil as id_profil, s.id_categorie as id_categorie ,s.titre as titre, to_char(s.date_sujet, \'DD month YYYY at HH24:MI:SS\') as date_sujet, p.login as login, s.nb_reponse as nb_reponse 
						  	 FROM sujet as s, profil as p 
							 WHERE p.id_profil=s.id_profil AND s.id_categorie = ? ORDER BY s.id_sujet DESC LIMIT ? OFFSET ? ;');

	$reponse->execute(array($idCategorie, $nombre, $debut));

	return $reponse->fetchAll();
}
//catégorie : retourne le nombre max de page que l'on peut former vaec la taille passé en paramétre
function getpageMaxSujet($idCategorie, $taillePage){
	$db = getDb();
	$reponse = $db->prepare('SELECT COUNT(*), id_categorie FROM sujet WHERE id_categorie = ? GROUP BY id_categorie ;');
	$reponse->execute(array($idCategorie));

    return 1+intval(($reponse->fetch(PDO::FETCH_NUM)[0])/$taillePage);
}




//sujet récupére les info du profil et du sujet pour un id de sujet
function getSujetProfil($idSujet){
	$db = getDb();

	$reponse = $db->prepare('SELECT p.id_profil as id_profil, s.id_categorie as id_categorie,s.id_sujet as id_sujet, p.login as login, p.nb_message as nb_message, p.sexe as sexe,
	    p.travail as travail, age(p.date_nais) as age, s.titre as titre, s.contenu as contenu, to_char(s.date_sujet, \'DD month YYYY at HH24:MI:SS\') as date_sujet
		FROM sujet s, profil p WHERE s.id_profil=p.id_profil AND s.id_sujet = ?;');
	$reponse->execute(array($idSujet));

	if($reponse->rowCount() ==1){
		return $reponse->fetch(); //on renvoie la première ligne du résultat
	}
	else 
		throw new Exception("Aucun sujet ne correspond à l'identifiant '$idSujet'");
	return $reponse;
}

//sujet : retourne les $nombre derniers commentaire à la page $page pour un sujet
function getCommentairePage($idSujet, $nombre, $page){
	$db = getDb();
	$debut = $nombre * ($page-1); // du i eme sujet
	$reponse = $db->prepare('SELECT c.id_commentaire as id_commentaire, c.titre as titre, c.auteur as auteur, c.email as email, c.contenu as contenu, to_char(c.date_commentaire, \'DD month YYYY at HH24:MI:SS\') as date_commentaire
							 FROM commentaire c WHERE c.id_sujet = ? ORDER BY c.id_sujet LIMIT ? OFFSET ?;' );
	$reponse->execute(array($idSujet, $nombre, $debut));

	return $reponse->fetchAll();
}
//sujet : retourne les infos de la cétégorie correspondante
function getTitreCategorie($idSujet){
	$db = getDb();

	$reponse = $db->prepare('SELECT c.titre as titre, c.id_categorie as id_categorie FROM categorie c, sujet s WHERE s.id_categorie = c.id_categorie AND s.id_sujet = ?;');
	$reponse->execute(array($idSujet));

	if($reponse->rowCount() ==1){
		return $reponse->fetch(); //on renvoie la première ligne du résultat
	}
	else 
		throw new Exception("Le sujet '$idSujet' ne correspond à aucune catégorie.");
	return $reponse;
}
// sujet : Nombre de sujet pour le sujet sélectionné
function getpageMaxCommentaire($idSujet, $taillePage){
	$db = getDb();
	$reponse = $db->prepare('SELECT COUNT(*), id_sujet FROM commentaire WHERE id_sujet = ? GROUP BY id_sujet ;');
	$reponse->execute(array($idSujet));

    return 1+intval(($reponse->fetch(PDO::FETCH_NUM)[0])/$taillePage);
}

//requete pour insérer un nouveau sujet
function postSujet($id_categorie, $id_profil, $titre, $contenu){
	$db = getDb();//connexion
	//insertion dans la bd
	$post = $db->prepare('INSERT INTO sujet(id_categorie, id_profil, titre, contenu) VALUES(?, ?, ?, ?);');
	$post->execute(array(secureData($id_categorie), secureData($id_profil), secureData($titre), secureData($contenu)));
	
	//echo 'le sujet est bien envoyé !';
}
// requete pour supprimer un sujet
function deleteSujet($id_sujet){
	$db = getDb();//connexion
	//suppression du sujet
	$post = $db->prepare('DELETE FROM sujet WHERE id_sujet = ?;');
	$post->execute(array($id_sujet));

}

//requete pour insérer un nouveau commentaire
function postCommentaire($id_sujet, $auteur, $email, $titre, $contenu){
	$db = getDb();//connexion
	//insertion dans la bd
	$post = $db->prepare('INSERT INTO commentaire(id_sujet, auteur, email, titre, contenu) VALUES (?,?,?,?,?);');
	$post->execute(array(secureData($id_sujet), secureData($auteur), secureData($email), secureData($titre), secureData($contenu)));
	
	//echo 'le commentaire est bien envoyé !';
}
// requete pour supprimer un commentaire
function deleteCommentaire($id_commentaire){
	$db = getDb();//connexion
	//suppression du commentaire
	$post = $db->prepare('DELETE FROM commentaire WHERE id_commentaire = ?;');
	$post->execute(array($id_commentaire));

}
  



//profil
function getProfil($idProfil){
	$db = getDb();
	$reponse = $db->prepare('SELECT id_profil, login, nom, prenom, sexe, ville, travail, nb_message, email, biographie,to_char(date_nais, \'DD month YYYY\') as date_nais  FROM profil WHERE id_profil= ?;');
	$reponse->execute(array($idProfil));


	if($reponse->rowCount() ==1){
		return $reponse->fetch(); //on renvoie la première ligne du résultat
	}
	else 
		throw new Exception("Aucun profil ne correspond à l'identifiant '$idPofil'");
	return $reponse;
}

//profil
function getSujetDe($idProfil){
	$db = getDb();
	$reponse = $db->prepare('SELECT s.id_sujet as id_sujet, c.titre as titre_categorie, s.titre as titre_sujet, to_char(s.date_sujet, \'DD month YYYY\') as date_sujet FROM sujet s, categorie c WHERE id_profil = ? AND s.id_categorie=c.id_categorie ORDER BY id_sujet DESC LIMIT 15 ;');
	$reponse->execute(array($idProfil));

	return $reponse->fetchAll();
}


function secureData($rep){
	$rep = htmlentities($rep);
	//$rep = addcslashes($rep, '()%[]');
	return $rep;
}



function getDb(){
	$host = "XXX"; 
	$db = "XXX";
	$user = "XXX"; 
	$pass = "XXX"; 
	
	
	$db = new PDO("pgsql:host=$host; dbname=$db", "$user", "$pass",
	        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

	return $db;

}


?>
