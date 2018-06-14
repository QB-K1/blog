<?php
// va inclure le fichier qui contient le pdo, comme ça si un jour change ID ou MDP de la BDD n'a à le changer que dans ce fichier externe, et en plus pas besoin de le réécrire
include 'application/bdd_connection.php';


// Requête SQL pour le select auteur du formulaire pour ajouter un article
$query = $pdo->prepare(
    '
        SELECT
            Id,
            FirstName,
            LastName
        FROM
            Author
    ');


// Exécute la requête SQL 
$query -> execute();

// Va enregistrer dans variable articles ce que j’ai récupéré par ma requête SQL
// Créé un tableau associatif où les keys sont les noms des colonnes et les values le contenu des cellules du tableau de la base de données
$authors = $query->fetchAll(PDO::FETCH_ASSOC);


// Requête SQL pour le select catégorie du formulaire pour ajouter un article
$query = $pdo->prepare(
    '
        SELECT
            Id,
            Name
        FROM
            Category
    ');


// Exécute la requête SQL 
$query -> execute();

// Va enregistrer dans variable articles ce que j’ai récupéré par ma requête SQL
// Créé un tableau associatif où les keys sont les noms des colonnes et les values le contenu des cellules du tableau de la base de données
$categories = $query->fetchAll(PDO::FETCH_ASSOC);


// va donner valeur index à template, qui est appelé dans le layout pour compléter le main
$template = 'add_article';
// include le layout pour réafficher header et footer à chaque page sans les retaper
include 'layout.phtml';

?>