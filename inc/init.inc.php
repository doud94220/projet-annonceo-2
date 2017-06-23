<?php
//--------------------------------- BDD
$pdo = new PDO('mysql:host=localhost;dbname=annonceo','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));



session_start(); //-démarrage d'une session


$content='';// variable initialisée à vide qui permetta de cotenir tout lesdifférents messages d'alertes,elle sera disponible à tout moment. Pratique pour un affichage global


define("RACINE_SITE",$_SERVER['DOCUMENT_ROOT']."/projet-annonceo/"); // chemin physique du site
define("URL", 'http://localhost/projet-annonceo/');


require_once('fonction.inc.php');