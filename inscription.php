<?php
require_once('inc/init.inc.php');
require_once('inc/haut.inc.php');
if($_POST)
{
	/* test sur le pseudo, si déja existant -> message d'erreur */
	$req=$pdo->query("SELECT * FROM membre WHERE pseudo='$_POST[pseudo]'");
	if($req->rowCount()>=1)
	{
		/* message d'erreur dans le cas ou le pseudo est déjà présent dans la BDD*/
		$content.='<div class="erreur" >Pseudo indisponible</div>';
	}

	//contrôle les champs du formulaire afin d'ajouter des antislash lorsqu'on saisie un champs avec une apostrophe
	foreach($_POST as $indice => $valeurs)
	{
		$_POST[$indice] = addslashes($valeurs);
	}

	if(empty($content))
	{
		/*$_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT); // */
		$pdo -> query("INSERT INTO membre (pseudo,mdp,nom,prenom,telephone,email,civilite) VALUES ('$_POST[pseudo]','$_POST[mdp]','$_POST[nom]','$_POST[prenom]','$_POST[telephone]','$_POST[email]','$_POST[civilite]')");
		$content .= "<div class ='validation'> Votre inscription a bien été prise en compte <a href=\projet-annonceo\connexion.php><u>Cliquez ici pour vous connecter</u></a></div>";
	}


echo $content;

}


?>


<form class="inscription" method="post" action="">
	<label><strong>Pseudo</strong></label><br>
	<input type="text" name="pseudo"><br><br>

	<label><strong>Mot de passe</strong></label><br>
	<input type="password" name="mdp"><br><br>


	
	<label><strong>Nom</strong></label><br>
	<input type="text" name="nom"><br><br>


	<label><strong>Prenom</strong></label><br>
	<input type="text" name="prenom" ><br><br>

	<label><strong>Civilite</strong></label><br>
	<select name= "civilite">
		<option value="m">M</option>
		<option value="f">F</option>
	</select><br><br>

	<label><strong>Téléphone</strong></label><br>
	<input type="text" name="telephone"><br><br>


	<label><strong>Email</strong></label><br>
	<input type="email" name="email" placeholder="jean@hotmal.fr..."><br><br>


	
	
	<input type="submit" value="Inscription"><br><br>

</form>







<?php

require_once('inc/bas.inc.php');


?>