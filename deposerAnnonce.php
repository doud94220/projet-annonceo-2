<?php
	require_once('inc/init.inc.php');
	require_once('inc/haut.inc.php');


	///// TRAITEMENT DONNEES DU POST
	if($_POST)
	{
		$url_photo = '';

		////////////// CONTROLES DATA DU POST //////////////
		// A faire plus tard


		////////////// Gestion du $_FILES (cf. photo(s) uploadée(s)) //////////////
		if(!empty($_FILES['photo']['name']))
		{

			$nom_photo = $_FILES['photo']['name'];
			$url_photo = URL . "photo/$nom_photo";
			$url_dossier_photo = RACINE_SITE . "photo/$nom_photo";

			//COPIE LE FICHIER du repertoire tmp vers le repertoire photo de notre projet
			copy($_FILES['photo']['tmp_name'], $url_dossier_photo);
		} 


		////////////// PAS D'ERREUR => INSERTION EN BDD //////////////


		/// Insertion dans la table photo
		// $req_photo=("
		// 	INSERT INTO photo (photo1, photo2, photo3, photo4 ,photo5)
		// 	VALUES (:photo1, :photo2, :photo3, :photo4, :photo5)
		// 		 ");
		// $statement_photo = $pdo->prepare($req_photo);
		// $statement_photo->bindValue(':photo1', $_POST['photo1'], PDO::PARAM_STR);
		// $statement_photo->bindValue(':photo2', $_POST['photo2'], PDO::PARAM_STR);
		// $statement_photo->bindValue(':photo3', $_POST['photo3'], PDO::PARAM_STR);
		// $statement_photo->bindValue(':photo4', $_POST['photo4'], PDO::PARAM_STR);
		// $statement_photo->bindValue(':photo5', $_POST['photo5'], PDO::PARAM_STR);
		// $response_requete_photo = $statement_photo->execute();
		// if ($response_requete_photo == false)
		// {
		// 	$content += "La requete d insertion dans table photo a echouée";
		// 	exit();
		// }

		/// Insertion dans la table annonce
		// $dernierIndiceInsere = $pdo->lastInsertId(); //recup id de la photo ds table photo

		$req_annonce=("
			INSERT INTO annonce (titre, description_courte, description_longue, prix, photo, pays, ville, adresse, cp, membre_id, photo_id, categorie_id, date_enregistrement)
			VALUES (:titre, :description_courte, :description_longue, :prix, :photo, :pays, :ville, :adresse, :cp, :membre_id, :photo_id, :categorie_id, :date_enregistrement)
				 ");
		$statement_annonce = $pdo->prepare($req_annonce);
		$statement_annonce->bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
		$statement_annonce->bindValue(':description_courte', $_POST['descriptionCourte'], PDO::PARAM_STR);
		$statement_annonce->bindValue(':description_longue', $_POST['descriptionLongue'], PDO::PARAM_STR);
		$statement_annonce->bindValue(':prix', $_POST['prix'], PDO::PARAM_STR);
		$statement_annonce->bindValue(':photo', $url_photo, PDO::PARAM_STR);
		$statement_annonce->bindValue(':pays', $_POST['pays'], PDO::PARAM_STR);
		$statement_annonce->bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
		$statement_annonce->bindValue(':adresse', $_POST['adresse'], PDO::PARAM_STR);
		$statement_annonce->bindValue(':cp', $_POST['codePostal'], PDO::PARAM_STR);
		$statement_annonce->bindValue(':membre_id', 1, PDO::PARAM_STR);
		$statement_annonce->bindValue(':photo_id', 1, PDO::PARAM_STR);
		$statement_annonce->bindValue(':categorie_id', 1, PDO::PARAM_STR);
		$statement_annonce->bindValue(':date_enregistrement', date('Y-m-d H:i:s'), PDO::PARAM_STR);
		$statement_annonce->execute();

	}

	echo $content;
?>

	<h1>Déposer une annonce</h1>
	
	<form id="formDeposerAnnonce" action="" method="post" enctype="multipart/form-data">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<label for="titre">Titre : </label><br>
					<input type="titre" name="titre"><br><br>
				</div>
				<div class="col-md-6">
					<label for="photos">Photos : </label><br>
					<input type="file" name="photo1">
					<input type="file" name="photo2">
					<input type="file" name="photo3">
					<input type="file" name="photo4">
					<input type="file" name="photo5">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label for="descriptionCourte">Description Courte : </label><br>
					<textarea name="descriptionCourte" cols="22" rows="3"></textarea><br><br>
				</div>
				<div class="col-md-6">
					<label for="pays">Pays : </label><br>
					<select name="pays">
						<option value="">Faites un choix</option>
						<option value="FR">France</option>
						<option value="ES">Espagne</option>
						<option value="UK">Angleterre</option>
					</select><br><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label for="descriptionLongue">Description Longue : </label><br>
					<textarea name="descriptionLongue" cols="22" rows="6"></textarea><br><br>
				</div>
				<div class="col-md-6">
					<label for="ville">Ville : </label><br>
					<select name="ville">
						<option value="">Faites un choix</option>
						<option value="paris">Paris</option>
						<option value="londres">Londres</option>
						<option value="madrid">Madrid</option>
					</select><br><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label for="prix">Prix : </label><br>
					<input type="prix" name="prix"><br><br>
				</div>
				<div class="col-md-6">
					<label for="titre">Adresse : </label><br>
					<input type="adresse" name="adresse"><br><br>		
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label for="categorie">Catégorie : </label><br>
					<select name="categorie">
						<option value="">Faites un choix</option>
						<option value="paris">Vetements</option>
						<option value="londres">Jouets</option>
						<option value="madrid">Immobilier</option>
					</select><br><br>
				</div>
				<div class="col-md-6">
					<label for="codePostal">Code postal : </label><br>
					<input type="codePostal" name="codePostal"><br><br>		
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					 <button type="submit" class="btn btn-primary">Enregistrer</button>
				</div>
			</div>
		</div> <!-- Fin .container -->
	</form>


<?php
	require_once('inc/bas.inc.php');
?>
