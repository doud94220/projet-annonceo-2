<?php
require_once('inc/init.inc.php');
require_once('inc/fonction.inc.php');

if(isset($_GET['action']) && $_GET['action']== 'deconnexion')
{
	unset($_SESSION['membre']);
	
}


if($_POST)
{
	//selection en BDD les info de l'internaute qui tente de saisir un pseudo valide
	$r=$pdo->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");
	

	if($r->rowCount()>=1)// nous comptons le nombre de résultats de la requete select, si il y a au moins 1 resultat, c'est qu'un pseudo de la BDD correspond bien au pseudo du formulaire
	{
		$membre=$r->fetch(PDO::FETCH_ASSOC);// on transforme le resultat en tableau array, nous avons donc dans ce tableau toutes les infos de l'internaute qui a saisi le bon pseudo
		if($_POST['mdp']== $membre['mdp']) // on compare le mdp saisi dans le form avec celui select en BDD
		{
			$content.='<div class="validation">Mot de passe connu ! </div>';
			$_SESSION['membre']['id_membre']= $membre['id_membre'];
			$_SESSION['membre']['pseudo']= $membre['pseudo'];
			$_SESSION['membre']['nom']= $membre['nom'];
			$_SESSION['membre']['prenom']= $membre['prenom'];
			$_SESSION['membre']['telephone']= $membre['telephone'];
			$_SESSION['membre']['email']= $membre['email'];
			$_SESSION['membre']['civilite']= $membre['civilite'];
			$_SESSION['membre']['date_enregistrement']= $membre['date_enregistrement'];
			$_SESSION['membre']['statut']= $membre['statut'];
			header("location:index.php");

		}
		else
		{
			$content.='<div class="erreur>Erreur de mot de passe ! </div>';
		}
	}
	else
	{
		$content.='<div class="erreur"> Erreur de pseudo </div>';
	}

}
echo $content;
require_once('inc/haut.inc.php');





?>




<form class="connexion" method="post" action="">
	<label><strong>Pseudo</strong></label><br>
	<input type="text" name="pseudo" placeholder="Yoan28.."><br><br>

	<label><strong>Mot de passe</strong></label><br>
	<input type="password" name="mdp" placeholder="mot de passe..."><br><br>
	<input type="submit" value="Connexion"><br><br>
	<span> Vous n'avez pas encore de compte ? Inscrivez vous <a href="inscription.php"> ICI </a></span> 
</form>





<?php

require_once('inc/bas.inc.php');


?>