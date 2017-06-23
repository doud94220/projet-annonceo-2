<?php

function internauteEstConnecte()
{
	if(!isset($_SESSION['membre']))
	{
		return false;
	}
	else
	{
		return true;
	}

}


function internauteEstConnecteEtEstAdmin() // cette fonction m'indique si lemembre est admin
{
	if(internauteEstConnecte() && $_SESSION['membre']['statut']==1) // si la session du membre est définie, nous regardons si il est admin, si c'est le cas, nous retournons true
	{
		return true;
	}
	else
	{
		return false;
	}
	
}


function debug($var, $mode=2)
{
	////// Affichage de l'argument $var
	if ($mode == 1)
	{
		echo "<br><br><strong>DEBUG : Affichage de la variable passée en argument : </strong><br><br>";
		echo '<pre>'; var_dump($var); echo '</pre><br><br>';		
	}
	else
	{
		echo "<br><br><u>DEBUG : Affichage de la variable passée en argument : </u><br><br>";
		echo '<pre>'; print_r($var); echo '</pre><br><br>';				
	}
}


?>