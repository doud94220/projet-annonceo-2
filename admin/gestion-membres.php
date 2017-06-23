<?php
require_once('../inc/init.inc.php');
require_once('../inc/haut.inc.php');



// ************** AFFICHAGE MEMBRES ---------------------- //


	$rq=$pdo->query("SELECT id_membre,pseudo,mdp,nom,prenom,telephone,email,civilite,statut,date_enregistrement FROM membre");
	$content.= "<h1>Affichage des " . $rq->rowCount() . " membre(s)</h1>";
	$content.= "<table border='1' style='border-collaspe:collapse;'><tr> ";

	for($i = 0; $i<$rq->columnCount(); $i++)
	{
		$colonne = $rq->getColumnMeta($i);
		$content .="<th>$colonne[name]</th>";
	}

	$content.= "<th>Modification</th>";
	$content.= "<th>Supression</th>";

	$content.= "</tr>";

	while($rqt=$rq->fetch(PDO::FETCH_ASSOC))
	{
		$content .= '<tr>';
		foreach($rqt as $indice => $valeur)
		{
				$content.= "<td>$valeur</td>";

		}
		$content .="<td><a href=\"?action=modification&id_membre=$rqt[id_membre]\"><img src='../inc/img/edit.png'></a></td>";
		$content .='<td><a href="?action=suppression&id_membre='. $rqt['id_membre']. '" OnClick="return(confirm(\'En êtes vous certain ?\'));"><img src="../inc/img/delete.png"></a></td>';

		$content .= '</tr>';

	}
	$content.= "</table>";


echo $content;
?>

	<br><br><br>
	<div class="container">
			<div class="row">

				<div class="col-md-6">
					<label for="pseudo">Pseudo : </label><br>
					
					<input type="text" name="titre"><br><br>
				</div>

				<div class="col-md-6">
					<label for="email">Email : </label><br>
					<input type="email" name="email"><br><br>
				</div>

			</div>


			<div class="row">
				<div class="col-md-6">
					<label for="mdp">Mot de passe : </label><br>
					<input type="text" name="mdp"><br><br>
				</div>

				<div class="col-md-6">
					<label for="telephone">Téléphone: </label><br>
					<input type="text" name="telephone"><br><br>
				</div>

			</div>

			<div class="row">
				<div class="col-md-6">
					<label for="nom">Nom: </label><br>
					<input type="text" name="nom"><br><br>
				</div>
				<div class="col-md-6">
					<label for="civilite">Civilité: </label><br>
					<select name="civilite">
						<option value="h">Homme</option>
						<option value="f">Femme</option>
					</select>
				</div>
			</div>


			<div class="row">
				<div class="col-md-6">
					<label for="prenom">Prénom: </label><br>
					<input type="text" name="prenom"><br><br>
				</div>
				<div class="col-md-6">
					<label for="statut">Statut: </label><br>
					<select name="statut">
						<option value="admin">Admin</option>
						<option value="user">User</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<input id="save_member" type="submit" value="Enregistrer">
				</div>
				
			</div>
		</div>



<?php

require_once('../inc/bas.inc.php');


?>		