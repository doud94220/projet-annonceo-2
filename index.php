<?php
require_once('inc/init.inc.php');
require_once('inc/haut.inc.php');

?>
	
				<!-- 	
					PAS DE COMBINAISON DES 2 FORMULAIRES : C'est l'un ou l'autre (pour l'instant)
					Pour l'indstant je limite toutes les requetes issues des formulaires à 3 lignes (cf. LIMIT 3)
				-->
	

	<div class="conteneurFlex">

		<div id="formGauchePageAccueil">
			<!-- FORMULAIRE A GAUCHE PAGE D'ACCUEIL -->
			<form method="post" action="index.php">

				<input type="hidden" name="formNumero1" value="vrai"><br><br> <!--  Pour identifier que c'est le premier form -->

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

				<input type="hidden" name="formNumero2" value="vrai"><br><br> <!--  Pour identifier que c'est le deuxieme form -->

				<select name="trieAnnonces">
					<option value="trieParPrixMoinsCherAuPlusCher">Trier par prix (du moins cher au plus cher)</option>
					<option value="trieParPrixPlusCherAuMoinsCher">Trier par prix (du plus cher au moins cher)</option>
					<option value="trieParDatePlusAnciennePlusRecente">Trier par date (de la plus ancienne à la plus récente)</option>
					<option value="trieParDatePlusRecentePlusAncienne">Trier par date (de la plus récente à la plus ancienne)</option>
					<option value="trieParMeilleurVendeur">Les meilleurs vendeurs en premier</option>
				</select><br><br>

				<input type="submit" value="Filtrer"><br>

			</form><br><br>

			<?php
				if(!empty($_POST['formNumero1'])) //Validation des data du form tout à gauche
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
				} //Fin du traitement des données du form 1

				elseif(!empty($_POST['formNumero2'])) //Validation des data du form du milieu avec les 4 filtrages au choix
				{
					$trieAnnonces = $_POST['trieAnnonces'];
					
					//Requete en BDD
					$requeteFiltrante = "";
					switch ($trieAnnonces)
					{
						case "trieParPrixMoinsCherAuPlusCher" : 
							$requeteFiltrante = "SELECT * FROM annonce order by prix asc limit 3";
							break;
						case "trieParPrixPlusCherAuMoinsCher" :
							$requeteFiltrante = "SELECT * FROM annonce order by prix desc limit 3";
							break;
						case "trieParDatePlusAnciennePlusRecente" :
							$requeteFiltrante = "SELECT * FROM annonce order by date_enregistrement asc limit 3";
							break;
						case "trieParDatePlusRecentePlusAncienne" :
							$requeteFiltrante = "SELECT * FROM annonce order by date_enregistrement desc limit 3";
							break;
						case "trieParMeilleurVendeur" :
							$requeteFiltrante = "select * from annonce
												 where membre_id in
								                    (select membre_id2 as id_membre_note
								                     from note
								                     group by membre_id2
								                     order by avg(note) desc
													)
												limit 3
													";
							break;
					}

					$resultatForm2 = $pdo->query($requeteFiltrante);
					if ($resultatForm2->rowCount() <= 0) //Si pas de ligne retournée par requête ci-dessus
					{
						echo "Pas de résultats pour vos critères de filtrage.";
					}
					else //Afficher les annonces dans un tableau dans la partie de droite de la page
					{
						echo"<div id='produitsPageAccueil'>
								<table>
							";

						while ($annoncesFiltrees = $resultatForm2->fetch(PDO::FETCH_ASSOC))
						{
							$urlPhoto = $annoncesFiltrees['photo'];
							$titre = $annoncesFiltrees['titre'];
							$idAnnonce =  $annoncesFiltrees['id_annonce'];
							$descriptionCourte = $annoncesFiltrees['description_courte'];
							$prix = $annoncesFiltrees['prix'];
							$idMembre = $annoncesFiltrees['membre_id'];

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

				} //Fin du traitement des données du form 2

				else //Si aucun formulaire ,'a été validé précédemment, alors afficher "Bienvenue"
				{
					echo "Bienvenue sur notre site !";
				}
			?>
		

		</div> <!-- Fin partiePrincipalePageAccueil -->

	</div> <!-- Fin conteneurFlex" -->



<?php
	require_once('inc/bas.inc.php');
?>
