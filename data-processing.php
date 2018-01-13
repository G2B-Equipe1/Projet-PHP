<?php
require 'base.php';
session_start();
$action = $_POST['action'];
if($action == 'S\'inscrire')
{
    $today = date('Y-m-d');
    $query = 'INSERT INTO user (identifiant, sexe, mail, password, telephone, pays, date ) 
    VALUES (\'' . $id . '\', \'' . $sexe . '\', \'' . $email . '\', \'' . $password . '\', \'' .
        $téléphone . '\', \'' . $pays . '\', \'' . $today . '\')';

    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur dans requête<br />';
// Affiche le type d'erreur.
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
// Affiche la requête envoyée.
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }

    echo 'Enregistrement en base de données effectuée <br>';
}
else if ($action == 'Se connecter')
{
    $mail = $_POST['id'];
    $mdp = $_POST['mdp'];
    $query = 'SELECT mdp FROM user WHERE email = \'' . $mail . '\'';

    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur dans la requete<br />';
        echo '<a href="user_space.php">Revenir à l\'authetification</a>';
        exit();
    }

    if(!mysqli_num_rows($dbResult))
    {
        echo 'Pas de correspondance dans la base de données<br />';
        echo '<a href="user_space.php">Revenir à l\'authetification</a>';
        exit();
    }

    $row = mysqli_fetch_assoc($dbResult);
    if( $mdp == $row['mdp'])
    {

        $_SESSION['mail'] = $mail;
        $_SESSION['password'] = $mdp;
        header('Location: user_space.php');

    }
    else {
        echo 'NOON';
    }
}
else if($action == 'Changer mot de passe')
{
    $ancienmdp = $_POST['ancienmdp'];
    $nouveaumdp = $_POST['nouveaumdp'];
    $confirmationmdp = $_POST['confirmationmdp'];
    $pass = $_SESSION['password'];
    if( $ancienmdp === $pass ){
        if(strcmp($nouveaumdp , $confirmationmdp ) === 0)
        {
            unset($_SESSION['changefail1']);
            unset($_SESSION['changefail2']);
            $query = 'UPDATE user SET mdp = \'' . $_POST['nouveaumdp'] . '\' WHERE email = \'' . $_SESSION['mail'] . '\'';
            if(!($dbResult = mysqli_query($dbLink, $query)))
            {
                echo 'Erreur dans requête<br />';
                // Affiche le type d'erreur.
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br/>';
                exit();
            }
            if(!mysqli_affected_rows($dbLink)) // N'est jamais censé arriver
            {
                $_SESSION['Nomatch'] = '';
                header('Location: user_space.php');
            }
            $_SESSION['password'] = $_POST['nouveaumdp'];
            $_SESSION['changesuccess'] = '';
            header('Location: user_space.php');
        }
        else
        {
            unset($_SESSION['changefail1']);
            unset($_SESSION['changesuccess']);
            $_SESSION['changefail2'] = '';
            header('Location: user_space.php');
        }

    }
    else
    {
        unset($_SESSION['changefail2']);
        unset($_SESSION['changesuccess']);
        $_SESSION['changefail1'] = '';
        header('Location: user_space.php');
    }
}
else if($action == 'Se déconnecter')
{
    $_SESSION = array();
    header('Location: user_space.php');
}
