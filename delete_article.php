<?php
// va inclure le fichier qui contient le pdo, comme ça si un jour change ID ou MDP de la BDD n'a à le changer que dans ce fichier externe, et en plus pas besoin de le réécrire
include 'application/bdd_connection.php';


// si id n'est pas présent dans les infos récup en URL ou si différent d'un chiffre alors renvoie à page index.php
if(!array_key_exists('id', $_GET) || !ctype_digit($_GET['id']))
{
    header('Location: index.php');
    exit();
}


// Requête SQL pour les posts du blog
$query = $pdo->prepare(
    '
        DELETE FROM 
            `Post`
        WHERE 
            `Id` = ?
    ');

// Exécute la requête SQL en évitant injection SQL (récupère valeur correspondant aux names des champs du form)
    // va chercher id en GET car rentré dans action du bouton qui va alors l'insérer dans l'URL puis le récup (voir intval dans le admin.phtml)
$query -> execute(array($_GET['id']));


// va renvoyer à page correspondant à admin
header('Location: admin.php');

// exit pour montrer que actions sur page actuelles finies pour l'instant
exit();

?>