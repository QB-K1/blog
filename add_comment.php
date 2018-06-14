<?php
// va inclure le fichier qui contient le pdo, comme ça si un jour change ID ou MDP de la BDD n'a à le changer que dans ce fichier externe, et en plus pas besoin de le réécrire
include 'application/bdd_connection.php';


// Requête SQL pour créer un commentaire
    // pas besoin de mettre Id dans la requête car dans la table est configuré pour s'incrémenter auto
    // NOW() va mettre le timestamp actuel (donc heure de publication)
$query = $pdo->prepare(
    '
        INSERT INTO
            Comment(
                NickName,
                Contents,
                CreationTimestamp,
                Post_Id)
        VALUES(
            ?,
            ?,
            NOW(),
            ? )
    ');


// Exécute la requête SQL en évitant injection SQL (récupère valeur correspondant aux names des champs du form)
    // Ex : postId est le nom contenu dans la balise form, qui représente la valeur à insérer dans la colonne Post_Id récup dans la requête SQL
$query -> execute(array(
                        $_POST['nickName'], 
                        $_POST['contents'], 
                        $_POST['postId']
                    ));

// va renvoyer à page correspondant à article commenté
header('Location: show_article.php?id='.$_POST['postId']);

// exit pour montrer que actions sur page actuelles finies pour l'instant
exit();

?>