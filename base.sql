CREATE DATABASE IF NOT EXISTS annonceo;

USE annonceo;

CREATE TABLE membre (
 	id_membre INT(3) NOT NULL AUTO_INCREMENT,
 	pseudo VARCHAR(20) NOT NULL,
 	mdp VARCHAR(60) NOT NULL,
 	nom VARCHAR(20) NOT NULL,
 	prenom VARCHAR(20) NOT NULL,
 	telephone VARCHAR(20) NOT NULL,
 	email VARCHAR(50) NOT NULL,
	civilite enum('m','f') NOT NULL,
	statut INT(1) NOT NULL,
	date_enregistrement DATETIME,
  	PRIMARY KEY (id_membre)
) ENGINE=InnoDB ;

CREATE TABLE photo (
 	id_photo INT(3) NOT NULL AUTO_INCREMENT,
  	photo1 VARCHAR(255) NOT NULL,
   	photo2 VARCHAR(255),
    photo3 VARCHAR(255),
    photo4 VARCHAR(255),
    photo5 VARCHAR(255),
  	PRIMARY KEY (id_photo)
) ENGINE=InnoDB ;

CREATE TABLE categorie (
 	id_categorie INT(3) NOT NULL AUTO_INCREMENT,
  	titre VARCHAR(255) NOT NULL,
   	motscles TEXT NOT NULL,
  	PRIMARY KEY (id_categorie)
) ENGINE=InnoDB ;

CREATE TABLE annonce (
 	id_annonce INT(3) NOT NULL AUTO_INCREMENT,
  	titre VARCHAR(255) NOT NULL,
	description_courte VARCHAR(255) NOT NULL,
  	description_longue TEXT,
 	prix INT (10) NOT NULL,
  	photo VARCHAR(200) NOT NULL,
  	pays VARCHAR(20) NOT NULL,
  	ville VARCHAR(20) NOT NULL,
  	adresse VARCHAR(50) NOT NULL,
  	cp INT(5) NOT NULL,
  	membre_id INT(3),
  	photo_id INT(3),
  	categorie_id INT(3),
  	date_enregistrement DATETIME,
  	PRIMARY KEY (id_annonce),
  	CONSTRAINT FK_IdMembre FOREIGN KEY (membre_id) REFERENCES annonceo.membre(id_membre),
  	CONSTRAINT FK_IdPhoto FOREIGN KEY (photo_id) REFERENCES annonceo.photo(id_photo),
  	CONSTRAINT FK_IdCategorie FOREIGN KEY (categorie_id) REFERENCES annonceo.categorie(id_categorie)
) ENGINE=InnoDB ;

CREATE TABLE commentaire (
 	id_commentaire INT(3) NOT NULL AUTO_INCREMENT,
  	membre_id INT(3),
   	annonce_id INT(3),
  	date_enregistrement DATETIME,
   	PRIMARY KEY (id_commentaire),
  	CONSTRAINT FK_Id_Membre FOREIGN KEY (membre_id) REFERENCES annonceo.membre(id_membre),
  	CONSTRAINT FK_Id_Annonce FOREIGN KEY (annonce_id) REFERENCES annonceo.annonce(id_annonce)
) ENGINE=InnoDB ;

CREATE TABLE note (
 	id_note INT(3) NOT NULL AUTO_INCREMENT,
  	membre_id1 INT(3),
   	membre_id2 INT(3),
   	note INT(3) NOT NULL,
   	avis TEXT NOT NULL,
	date_enregistrement DATETIME,
  	PRIMARY KEY (id_note),
  	CONSTRAINT FK_IdMmembre1 FOREIGN KEY (membre_id1) REFERENCES annonceo.membre(id_membre),
  	CONSTRAINT FK_IdMmembre2 FOREIGN KEY (membre_id2) REFERENCES annonceo.membre(id_membre)
) ENGINE=InnoDB ;
