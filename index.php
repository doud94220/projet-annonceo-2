<?php
require_once('inc/init.inc.php');
require_once('inc/haut.inc.php');

?>


	<div class="conteneurFlex">

		<div id="formGauchePageAccueil">
			<!-- FORMULAIRE A GAUCHE PAGE D'ACCUEIL -->
			<form method="post" action="index.php">

				<label for="categorie">Catégorie : </label><br>
				<select name="categorie">
						<?php
							echo '<option value="">Faites un choix</option>';
							$donnees = $pdo->query("SELECT distinct id_categorie, titre FROM categorie");
							while($categorie = $donnees->fetch(PDO::FETCH_ASSOC))
							{
								echo "<option value=" . $categorie['id_categorie'] . ">" . $categorie['titre'] . "</option>";
							}
						?> 
					</select><br><br>

				<label for="region">Région : </label><br>
				<select name="region">
					<option value="">Toutes les régions</option>
					<option value="ile-de-france">Ile-De-France</option>
					<option value="pays-de-la-loire">Pays de la loire</option>
					<option value="bretagne">Bretagne</option>
				</select><br><br>

				<label for="membre">Membre : </label><br>
				<select name="membre">
						<?php
							echo '<option value="">Faites un choix</option>';
							$donnees = $pdo->query("SELECT id_membre, pseudo FROM membre");
							while($categorie = $donnees->fetch(PDO::FETCH_ASSOC))
							{
								echo "<option value=" . $categorie['id_membre'] . ">" . $categorie['pseudo'] . "</option>";
							}
						?> 
				</select><br><br>

				<label for="prix">Votre prix max : </label><br>
				<input type="text" name="prix"><br><br>

				<input type="submit" value="Valider"><br><br>
			</form>
		</div> <!-- Fin formGauchePageAccueil -->


		<div id="partiePrincipalePageAccueil">
			<!-- FORMULAIRE TRIE PRIX PAGE D'ACCUEIL -->
			<form method="post" action="index.php">

				<select name="trieProduits">
					<option value="trieParPrixMoinsCherAuPlusCher">Trier par prix (du moins cher au plus cher)</option>
					<option value="trieParPrixPlusCherAuMoinsCher">Trier par prix (du plus cher au moins cher)</option>
					<option value="trieParDatePlusAnciennePlusRecente">Trier par date (de la plus ancienne à la plus récente)</option>
					<option value="trieParDatePlusRecentePlusAncienne">Trier par date (de la plus récente à la plus ancienne)</option>
					<option value="trieParMeilleurVendeur">Les meilleurs vendeurs en premier</option>
				</select><br><br>

				<input type="submit" value="Filtrer"><br>

			</form><br><br>

			<?php
				if($_POST) //Validation des data du premier form
				{
					////////////// CONTROLES DATA DU POST //////////////
					// A faire plus tard

					////////////// PAS D'ERREUR => SELECTION EN BDD //////////////     //Je gère pas la région pour l'instant !!! Et je prends que 3 résultats max pour l'instant !!!
					$idCategorie = $_POST['categorie'];
					$idMembre = $_POST['membre'];
					$prix = $_POST['prix'];
					$resultat = $pdo->query("SELECT * FROM annonce WHERE categorie_id = '$idCategorie' AND membre_id = '$idMembre' AND prix <= '$prix' LIMIT 3");

					if ($resultat->rowCount() <= 0) //Si pas de ligne retournée par requête ci-dessus
					{
						echo "Pas de résultats pour vos critères.";
					}
					else //Afficher les annonces dans un tableau dans la partie de droite de la page
					{
						echo"<div id='produitsPageAccueil'>
								<table>
							";

						while ($annonces = $resultat->fetch(PDO::FETCH_ASSOC))
						{
							$urlPhoto = $annonces['photo'];
							$titre = $annonces['titre'];
							$idAnnonce =  $annonces['id_annonce'];
							$descriptionCourte = $annonces['description_courte'];
							$prix = $annonces['prix'];
							$idMembre = $annonces['membre_id'];

							//Recup du pseudo du vendeur
							$resultatPseudoVendeur = $pdo->query("SELECT pseudo from membre where id_membre = '$idMembre'");
							$arrayPseudoVendeur = $resultatPseudoVendeur->fetch(PDO::FETCH_ASSOC);
							$pseudoVendeur = $arrayPseudoVendeur['pseudo'];

							//Recup de la note moyenne du vendeur de l'annonce
							$resultatNoteMoyenneVendeur = $pdo->query("SELECT round(AVG(note),1) AS note_moyenne from note where membre_id2 = '$idMembre'");
							$arrayNoteMoyenneVendeur = $resultatNoteMoyenneVendeur->fetch(PDO::FETCH_ASSOC);
							$noteMoyenneVendeur = $arrayNoteMoyenneVendeur['note_moyenne'];

							echo"
									<tr>
										<td><img src='" . $urlPhoto . "' width='100px' height='80px'></td>
										<td>
											<p><a href='ficheAnnonce.php?id_annonce=" . $idAnnonce . "'>" . $titre . "</a></p>
											<p>" . $descriptionCourte . "</p>
											<p>" . $pseudoVendeur . " : " . $noteMoyenneVendeur . "</p>
										</td>
										<td>
											<p>" . $prix . "€ </p>
										</td>
									</tr>
							 	";
						}
						echo"	</table>
							</div>
							";
					}
				} //Fin du traitement des date du POST
			?>
		

		</div> <!-- Fin partiePrincipalePageAccueil -->

	</div> <!-- Fin conteneurFlex" -->


<?php
	require_once('inc/bas.inc.php');
?>