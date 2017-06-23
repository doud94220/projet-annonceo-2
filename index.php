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
					<option value="">Toutes les catégories</option>
					<option value="emploi">Emploi</option>
					<option value="véhicule">Véhicule</option>
					<option value="immobilier">Immobilier</option>
					<option value="vacances">Vacances</option>
					<option value="multimedia">Multimedia</option>
					<option value="loisirs">Loisirs</option>
					<option value="matériel">Matériel</option>
					<option value="services">Services</option>
					<option value="maison">Maison</option>
					<option value="vetements">Vetements</option>
					<option value="autres">Autres</option>
				</select><br><br>

				<label for="region">Région : </label><br>
				<select name="region">
					<option value="">Toutes les régions</option>
					<option value="emploi">Ile-De-France</option>
					<option value="véhicule">Pays de la loire</option>
					<option value="immobilier">Bretagne</option>
				</select><br><br>

				<label for="membre">Membre : </label><br>
				<select name="membre">
					<option value="">Tous les membres</option>
					<option value="emploi">dugnou49</option>
					<option value="véhicule">dupont75</option>
					<option value="immobilier">tartanpion92</option>
				</select><br><br>

				<label for="prix">Prix : </label><br>
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

			<div id="produitsPageAccueil">
				<table>
					<tr>
						<td><img src="inc/img/polo-blanche.jpg" width='100px' height='80px'></td>
						<td>
							<p><a href="ficheAnnonce.php?aaaaaaaa">Nom Produit1</a></p>
							<p>Description Produit1</p>
							<p>Dernier avis du produit1</p>
						</td>
						<td>
							<p>Prix</p>
						</td>
					</tr>
					<tr>
						<td><img src="inc/img/polo-blanche.jpg" width='100px' height='80px'></td>
						<td>
							<p><a href="ficheAnnonce.php?bbbbbbbb">Nom Produit2</a></p>
							<p>Description Produit2</p>
							<p>Dernier avis du produit2</p>
						</td>
						<td>
							<p>Prix</p>
						</td>
					</tr>
					<tr>
						<td><img src="inc/img/polo-blanche.jpg" width='100px' height='80px'></td>
						<td>
							<p><a href="ficheAnnonce.php?ccccccccc">Nom Produit3</a></p>
							<p>Description Produit3</p>
							<p>Dernier avis du produit3</p>
						</td>
						<td>
							<p>Prix</p> 
						</td>
					</tr>
				</table>
			</div>
		</div> <!-- Fin partiePrincipalePageAccueil -->
	</div> <!-- Fin conteneurFlexPageAccueil" -->


<?php
	require_once('inc/bas.inc.php');
?>
