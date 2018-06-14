<?php
// va inclure le fichier qui contient le pdo, comme ça si un jour change ID ou MDP de la BDD n'a à le changer que dans ce fichier externe, et en plus pas besoin de le réécrire
include 'application/bdd_connection.php';


// Requête SQL pour créer un commentaire
    // pas besoin de mettre Id dans la requête car dans la table est configuré pour s'incrémenter auto
    // NOW() va mettre le timestamp actuel (donc heure de publication)
$query = $pdo->prepare(
    '
        INSERT INTO
            Post(
                Title,
                Contents,
                CreationTimestamp,
                Author_Id,
                Category_Id)
        VALUES(
            ?,
            ?,
            NOW(),
            ?,
            ? )
    ');


// Exécute la requête SQL en évitant injection SQL (récupère valeur correspondant aux names des champs du form)
    // Ex : articleTitle est le nom contenu dans la balise form, qui représente la valeur à insérer dans la colonne articleTitle récup dans la requête SQL
$query -> execute(array(
                        $_POST['articleTitle'], 
                        $_POST['articleContent'], 
                        $_POST['articleAuthor'], 
                        $_POST['articleCategory']
                    ));


// va renvoyer à page correspondant à admin
header('Location: admin.php');

// exit pour montrer que actions sur page actuelles finies pour l'instant
exit();

?>