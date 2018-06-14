<?php


// Création d'un PDO 
$pdo = new PDO
	(
		'mysql:host=localhost;dbname=blog;charset=UTF8',
		'root',
		'mdp'
);
	/* mysql:host= est pour l’adresse du serveur où est la base de données
		dbname = est pour le nom de la base de données
		root = login PHPmyAdmin
		mdp = MDP PHPmyAdmin */

?>