<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Annonceo</title>
	<link rel="stylesheet" type="text/css" href="/projet-annonceo/inc/css/style.css">
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body>
	<header>
		<div class="conteneur">
			<nav>
				 <?php
					if(internauteEstConnecteEtEstAdmin())
					{
				
						echo '<a href="' . URL . 'admin/gestion-annonces.php">Gestion des annonces</a>';
						echo '<a href="' . URL . 'admin/gestion-categories.php">Gestion des catégories</a>';
						echo '<a href="' . URL . 'admin/gestion-membres.php">Gestion des membres</a>';
						echo '<a href="' . URL . 'admin/gestion-commentaire.php">Gestion des commentaires</a>';
						echo '<a href="' . URL . 'admin/gestion-notes.php">Gestion des notes</a>';
				
					}
					if(internauteEstConnecte())
					{
						echo '<a href="' . URL . 'index.php">Annonceo</a>';
						echo '<a href="' . URL . 'index.php">Qui sommes nous ?</a>';
						echo '<a href="' . URL . 'contact.php">Contact</a>';
						echo '<input type="search" name="search" id="search" placeholder="Recherche...">';
						echo '<a href="' . URL . 'connexion.php?action=deconnexion"> Se déconnecter</a>';
						
					}
				 	else
					{
						echo '<a href="' . URL . 'index.php">Annonceo</a>';
						echo '<a href="' . URL . 'index.php">Qui sommes nous ?</a>';
						echo '<a href="' . URL . 'contact.php">Contact</a>';
						echo '<input type="search" name="search" id="search" placeholder="Recherche...">';
						echo '<a href="' . URL . 'connexion.php">Espace Membre</a>';						
					}
					?> 
				<!-- <ul>
						<li><a href="index.php" title="Annonceo">Annonceo</a>
						<li><a href="#">Qui sommes nous ?</a></li>
						<li><a href="contact.php">Contact</a></li>
						<li><input type="search" name="search" id="search" placeholder="Recherche...">
<<<<<<< HEAD
<<<<<<< HEAD
						<li><a href="connexion.php">Espace Membre</a></li>
				</ul> -->

				<!-- 		<li><a href="#">Espace Membre</a></li>
								</ul>
				 -->
			</nav>
		</div>
	</header>
		
	<!-- <section>
		<div class="conteneur">
	
						<li><a href="#">Espace Membre</a></li>
				</ul>
	
						<li><a href="connexion.php">Espace Membre</a></li>
				</ul>
	
			</nav>
		</div>
	</header> -->


	<section>
		<div class="conteneur">
