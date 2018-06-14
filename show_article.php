<?php

// si id n'est pas présent dans les infos récup en URL ou si différent d'un chiffre alors renvoie à page index.php
if(!array_key_exists('id', $_GET) || !ctype_digit($_GET['id']))
{
    header('Location: index.php');
    exit();
}


// va inclure le fichier qui contient le pdo, comme ça si un jour change ID ou MDP de la BDD n'a à le changer que dans ce fichier externe, et en plus pas besoin de le réécrire
include 'application/bdd_connection.php';


// Requête SQL pour le post du blog correspondant à id (titre cliqué)
$query = $pdo -> prepare(
    '
        SELECT
            Post.Id,
            Title,
            Contents,
            CreationTimestamp,
            FirstName,
            LastName
        FROM
            Post
        INNER JOIN
            Author
        ON
            Post.Author_Id = Author.Id
       WHERE
           Post.Id = ?
    ');


// Exécute la requête SQL en évitant injection SQL
$query -> execute(array($_GET['id']));

// Va enregistrer dans variable articles ce que j’ai récupéré par ma requête SQL
// Créé un tableau associatif où les keys sont les noms des colonnes et les values le contenu des cellules du tableau de la base de données
$article = $query -> fetch(PDO::FETCH_ASSOC);


// Requête SQL pour récupérer les commentaires
$query = $pdo->prepare(
    '
        SELECT
            NickName,
            Contents,
            CreationTimestamp
        FROM
            Comment
        WHERE
            Post_Id = ?
    ');

// Exécute la requête SQL en évitant injonction SQL
$query->execute([$_GET['id']]);

// Va enregistrer dans variable articles ce que j’ai récupéré par ma requête SQL
// Créé un tableau associatif où les keys sont les noms des colonnes et les values le contenu des cellules du tableau de la base de données
$comments = $query->fetchAll(PDO::FETCH_ASSOC);


// va donner valeur index à template, qui est appelé dans le layout pour compléter le main
$template = 'show_article';
// include le layout pour réafficher header et footer à chaque page sans les retaper
include 'layout.phtml';

?>