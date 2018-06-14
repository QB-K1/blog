<?php
// va inclure le fichier qui contient le pdo, comme ça si un jour change ID ou MDP de la BDD n'a à le changer que dans ce fichier externe, et en plus pas besoin de le réécrire
include 'application/bdd_connection.php';

// affiche ce qui a été rentré dans formulaire - test
    // print_r($_POST);


// Requête SQL pour modifier un post du blog
$query = $pdo->prepare(
    '
        UPDATE 
            Post
        SET
            Title = ?,
            Contents = ?,
            Author_Id = ?,
            Category_Id = ?
        WHERE
            Id = ?
    ');


// Exécute la requête SQL en évitant injonction SQL et en récupérant ID de l'article pour n'afficher que lui dans le foreach et donc sur la page
    // Ex : articleTitle est le nom contenu dans la balise form, qui représente la valeur à insérer dans la colonne articleTitle récup dans la requête SQL
$query -> execute(array(
                        $_POST['articleTitle'], 
                        $_POST['articleContent'], 
                        $_POST['articleAuthor'], 
                        $_POST['articleCategory'], 
                        $_POST['postId']
                    ));


// va renvoyer à page correspondant à admin
header('Location: admin.php');

// exit pour montrer que actions sur page actuelles finies pour l'instant
exit();

?>