<?php
// va inclure le fichier qui contient le pdo, comme ça si un jour change ID ou MDP de la BDD n'a à le changer que dans ce fichier externe, et en plus pas besoin de le réécrire
include 'application/bdd_connection.php';

// Requête SQL pour les posts du blog
$query = $pdo->prepare(
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
        ORDER BY
            CreationTimestamp DESC
    ');

// Exécute la requête SQL
$query->execute();

// Va enregistrer dans variable articles ce que j’ai récupéré par ma requête SQL
// Créé un tableau associatif où les keys sont les noms des colonnes et les values le contenu des cellules du tableau de la base de données
$articles = $query->fetchAll(PDO::FETCH_ASSOC);


// va donner valeur index à template, qui est appelé dans le layout pour compléter le main
$template = 'index';
// include le layout pour réafficher header et footer à chaque page sans les retaper
include 'layout.phtml';

?>