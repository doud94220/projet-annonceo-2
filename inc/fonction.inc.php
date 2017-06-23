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



?>