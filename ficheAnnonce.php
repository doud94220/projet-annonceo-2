<?php
	require_once('inc/init.inc.php');
	require_once('inc/haut.inc.php');
?>


	<h1 id="titrePageFicheAnnonce">Produit Selectionné</h1>

	<div class="conteneurFlex">

		<!-- Image du produit assez grande -->
		<img src="inc/img/polo-blanche.jpg" width='250px' height='190px'>
		<p>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor, illum provident ipsa quidem culpa consequatur ut soluta dignissimos corrupti repellat maxime dolorum perferendis voluptatum vitae id est dolorem excepturi quam? Tempore ea veniam necessitatibus non sed accusantium vero! Consequuntur alias, nihil doloremque, pariatur earum eligendi exercitationem hic aliquam beatae porro corporis cupiditate voluptates dolorem explicabo cum eum esse architecto! Id delectus odit, modi veniam distinctio quidem iure sapiente tenetur nesciunt aliquid officiis nulla porro soluta, quas ratione? Quasi molestiae neque delectus minus animi facere voluptate, maiores error illo? Libero sed facere, repellendus delectus soluta reiciendis illo culpa porro distinctio. Asperiores.
		</p>
	</div>

	<!-- Petites infos sous le produit -->
	<ul id="infosProduitPageFicheAnnonce">
		<li>Date de publication : 01/01/2010</li>
		<li>Marie : *****</li>
		<li>€ : 10000€</li>
		<li>Adresse : 154 Rue de chaussons 94220 Charenton</li>
	</ul>

	<!-- Map google geooloc -->
	<iframe
		src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2626.594591966316!2d2.402590016027467!3d48.82779617928449!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6725970538403%3A0x949e3b28d8b18854!2s154+Rue+de+Paris%2C+94220+Charenton-le-Pont!5e0!3m2!1sfr!2sfr!4v1498140006776" allowfullscreen>
	</iframe>

	<h2>Autres Annonces</h2>
	<div id="autresAnnonces">
		<img src="inc/img/polo-blanche.jpg" width='22%' height="200px">
		<img src="inc/img/polo-blanche.jpg" width='22%' height="200px">
		<img src="inc/img/polo-blanche.jpg" width='22%' height="200px">
		<img src="inc/img/polo-blanche.jpg" width='22%' height="200px">	
	</div>

	<div id="liensEnBas">
		<a href="commentaire.php">Déposer un commentaire ou une note</a>
		<a href="annonces.php">Retour vers les annonces</a>
	</div>


<?php
	require_once('inc/bas.inc.php');
?>
