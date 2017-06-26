<?php
	require_once('inc/init.inc.php');
	require_once('inc/haut.inc.php');


	///////////////////////////// PAGE TERMINEE : Tout marche nikel, aucune valeur en dur, SAUF LE GOOGLE MAP /////////////////////////////


	if(isset($_GET['id_annonce']))
	{
		// On récupère tous les infos de la commande
		$resultat = $pdo->query("SELECT * FROM annonce WHERE id_annonce = '$_GET[id_annonce])'");

		//Analyse de la requete faite au-dessus
		if ($resultat->rowCount() <= 0) //Si pas de ligne retournée par requête ci-dessus
		{
			header("location:index.php"); //retour à la boutique
			exit();
		}
		else //Afficher le produit
		{
			//Recup du resultat de la requete sous la forme d'un tableau
			$annonceSelectionne = $resultat->fetch(PDO::FETCH_ASSOC);

			//On pioche les infos qui vont nous servir dans la page
			$idAnnonce = $annonceSelectionne['id_annonce'];
			$urlPhoto = $annonceSelectionne['photo'];
			$descriptionCourte= $annonceSelectionne['description_courte'];			
			$descriptionLongue = $annonceSelectionne['description_longue'];
			$datePublication = $annonceSelectionne['date_enregistrement'];
			$prix = $annonceSelectionne['prix'];
			$adresseVendeur = $annonceSelectionne['adresse'];
			$codePostalVendeur = $annonceSelectionne['cp'];
			$villeVendeur = $annonceSelectionne['ville'];
			$paysVendeur = $annonceSelectionne['pays'];
			$adressePostalecomplete = $adresseVendeur . " " . $codePostalVendeur . " " . $villeVendeur  . " " . $paysVendeur;
			$idCategorie = $annonceSelectionne['categorie_id'];
			$idMembre = $annonceSelectionne['membre_id'];
		}
	}
	else
	{
		echo "L'annonce a été retiréé...Désolé.";
		exit();
	}
?>

	<h1 id="titrePageFicheAnnonce"><?php echo "$descriptionCourte"?></h1>

	<div class="conteneurFlex">

		<!-- Image du produit assez grande -->
		<img src='<?php echo "$urlPhoto" ?>' width='250px' height='190px'>
		<p><?php echo "$descriptionLongue"?></p>
	</div>

	<!-- Petites infos sous le produit -->
	<ul id="infosProduitPageFicheAnnonce">
		<li><u>Date de publication</u> : <?php echo "$datePublication"?></li>

			<?php
				//Recup de la note moyenne du vendeur de l'annonce
				$resultatNoteMoyenneVendeur = $pdo->query("SELECT round(AVG(note),1) AS note_moyenne from note where membre_id2 = '$idMembre'");
				$arrayNoteMoyenneVendeur = $resultatNoteMoyenneVendeur->fetch(PDO::FETCH_ASSOC);
				$noteMoyenneVendeur = $arrayNoteMoyenneVendeur['note_moyenne'];

				//Recup du prénom du vendeur
				$resultatPrenomVendeur = $pdo->query("SELECT prenom from membre where id_membre = '$idMembre'");
				$arrayPrenomVendeur = $resultatPrenomVendeur->fetch(PDO::FETCH_ASSOC);
				$prenomVendeur = $arrayPrenomVendeur['prenom'];
			?>

		<li><?php echo "<u>$prenomVendeur</u> : $noteMoyenneVendeur" ?></li>
		<li><u>€</u>: <?php echo "$prix"?></li>
		<li><u>Adresse</u> : <?php echo "$adressePostalecomplete"?></li>
	</ul>

	<!-- Map google geooloc --> <!-- TOUJOURS EN DUR -->
	<iframe
		src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2626.594591966316!2d2.402590016027467!3d48.82779617928449!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6725970538403%3A0x949e3b28d8b18854!2s154+Rue+de+Paris%2C+94220+Charenton-le-Pont!5e0!3m2!1sfr!2sfr!4v1498140006776" allowfullscreen>
	</iframe>

	<h2>Autres Annonces de la même catégorie</h2>
	<?php
		//On récupère 4 annonces de la même catégorie
		$resultatDesAutresAnnonces = $pdo->query("SELECT photo FROM annonce WHERE categorie_id = '$idCategorie' AND id_annonce != '$idAnnonce' LIMIT 4");
		echo "<div id='autresAnnonces'>";
		while ($uneAutreAnnonce = $resultatDesAutresAnnonces->fetch(PDO::FETCH_ASSOC))
		{
			echo " <img src='" . $uneAutreAnnonce['photo'] . "' width = '22%' height='200px'>";
		}
		echo "</div>";
	?>

	<div id="liensEnBas">
		<a href="commentaire.php">Déposer un commentaire ou une note</a>
		<a href="annonces.php">Retour vers les annonces</a>
	</div>


<?php
	require_once('inc/bas.inc.php');
?>
