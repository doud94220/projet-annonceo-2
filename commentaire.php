<?php
	require_once('inc/init.inc.php');
	require_once('inc/haut.inc.php');
?>



<?php
	if(isset($_GET['id_annonce'])) //Si on a un id_annonce en GET, on on affiche un fom pour le user pour saisir commentaire et/ou note
	{
		echo"
			<h1>Vous êtes en train de déposer un commentaire et/ou une note</h1>

			<form method='post' action='commentaire.php'>

				<input type='hidden' name='verifFormCommentEtNote'>
				<input type='hidden' name='id_annonce' value=$_GET[id_annonce]>

				<label for='commentaire'>Commentaire sur le vendeur : </label><br>
				<textarea name='commentaire' cols='46' rows='10'></textarea><br><br><br>

				<label for='note'>Note sur le vendeur : </label><br>
				<select name='note'>
					<option value=''>Faites un choix</option>
					<option value='1'>1</option>
					<option value='2'>2</option>
					<option value='3'>3</option>
					<option value='4'>4</option>
					<option value='5'>5</option>
				</select><br><br>

				<label for='avis'>Avis sur le vendeur : </label><br>
				<input type='text' name='avis'><br><br>

				<input type='submit' value='Valider'><br>

			</form>
		";
	}

	elseif(isset($_POST['verifFormCommentEtNote'])) //Gestion de la creation du commentaire et/ou note suite à validation du form précédemment
	{
		if(!empty($_POST['commentaire'])) //Gestion de l'insertion du commentaire en BDD
		{
			$req_commentaire=("
				INSERT INTO commentaire(membre_id, annonce_id, commentaire, date_enregistrement)
				VALUES (:membre_id, :annonce_id, :commentaire, :date_enregistrement)
					 ");
			$idMembre = $_SESSION['membre']['id_membre']; //recup id du mmebre dans $_SESSION
			$idAnnonce = $_POST['id_annonce'];

			$statement_commentaire = $pdo->prepare($req_commentaire);
			$statement_commentaire->bindValue(':membre_id', $idMembre, PDO::PARAM_STR);
			$statement_commentaire->bindValue(':annonce_id', $idAnnonce, PDO::PARAM_STR);
			$statement_commentaire->bindValue(':commentaire', $_POST['commentaire'], PDO::PARAM_STR);
			$statement_commentaire->bindValue(':date_enregistrement', date('Y-m-d H:i:s'), PDO::PARAM_STR);		
			$response_requete_commentaire = $statement_commentaire->execute();

			if ($response_requete_commentaire == false)
			{
				$content += "<div class='alert alert-danger'>L insertion du commentaire a echoué...</div>";
			}
			else
			{
				$content += "<div class='alert alert-success'>Commentaire inséré</div>";
			}
		}

		if(!empty($_POST['note'])) //Gestion de l'insertion de la note en BDD
		{
			$req_note=("
					INSERT INTO note(membre_id1, membre_id2, note, avis, date_enregistrement) 
					VALUES (:membre_id1, :membre_id2, :note, :avis, :date_enregistrement)
					 ");

			//Recup de presque toutes les infos pour la requete	
			$idMembreQuiNote = $_SESSION['membre']['id_membre'];
			$idAnnonce = $_POST['id_annonce'];
			$note =  $_POST['note'];
			$avis =  $_POST['avis'];

			//Recup id vendeur à partir de id annonce
			$resultatIdVendeur = $pdo->query("SELECT membre_id from annonce where id_annonce = '$idAnnonce'");
			$arrayIdVendeur = $resultatIdVendeur->fetch(PDO::FETCH_ASSOC);
			$idVendeur = $arrayIdVendeur['membre_id'];

			$statement_note = $pdo->prepare($req_note);
			$statement_note->bindValue(':membre_id1', $idMembreQuiNote, PDO::PARAM_STR);
			$statement_note->bindValue(':membre_id2', $idVendeur, PDO::PARAM_STR);
			$statement_note->bindValue(':note', $note, PDO::PARAM_STR);
			$statement_note->bindValue(':avis', $avis, PDO::PARAM_STR);
			$statement_note->bindValue(':date_enregistrement', date('Y-m-d H:i:s'), PDO::PARAM_STR);
			$response_statement_note = $statement_note->execute();

			if ($response_statement_note == false)
			{
				$content += "<div class='alert alert-danger'>L insertion de la note a echoué...</div>";
			}
			else
			{
				$content += "<div class='alert alert-success'>Note et avis insérés</div>";
			}
		}
	}

	else //probleme, ni get ni post
	{
		$content += "<div class='alert alert-danger'>Ni get ni post.....</div>";
		//header('location:index.php');
	}


	// Afficher le ou les message(s)
	echo $content;
?>



<?php
	require_once('inc/bas.inc.php');
?>