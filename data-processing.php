<?php
require 'base.php';
session_start();
$action = $_POST['action'];
if($action == 'S\'inscrire')
{
    if(!mysqli_num_rows(mysqli_query($dbLink, 'SELECT email FROM user WHERE email = \''. $_POST['mail']. '\'')))
    {
        if(!mysqli_num_rows(mysqli_query($dbLink, 'SELECT email FROM user WHERE pseudo = \''. $_POST['pseudo']. '\'')))
        {
            if($_POST['mdp'] === $_POST['confirmationmdp'])
            {
                $today = date('Y-m-d');
                $query = 'INSERT INTO user (email, pseudo, mdp, date, categorie ) 
                      VALUES (\'' . $_POST['mail'] . '\', \'' . $_POST['pseudo'] . '\', \''
                    . $_POST['mdp'] . '\', \'' . $today . '\', \'standard\' )';

                if(!($dbResult = mysqli_query($dbLink, $query)))
                {
                    echo 'Erreur dans requête<br />';
                    // Affiche le type d'erreur.
                    echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                    // Affiche la requête envoyée.
                    echo 'Requête : ' . $query . '<br/>';
                    exit();
                }
                $_SESSION['mail'] = $_POST['mail'];
                $_SESSION['password'] = $_POST['mdp'];
                $_SESSION['pseudo'] = $_POST['pseudo'];
                $_SESSION['categorie'] = 'standard';
                $_SESSION['inscriptionreussie'] = '';
                header('Location: user_space.php');
            }
            else
            {
                $_SESSION['mauvaismdp'] = '';
                header('Location: user_space.php');
            }
        }
        else
        {
            $_SESSION['pseudopris'] = '';
            header('Location: user_space.php');
        }
    }
    else
    {
        $_SESSION['mailpris'] = '';
        header('Location: user_space.php');
    }

}
else if ($action == 'Se connecter')
{
    $mail = $_POST['id'];
    $mdp = $_POST['mdp'];
    $query = 'SELECT * FROM user WHERE email = \'' . $mail . '\'';

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
        $_SESSION['categorie'] = $row['categorie'];
        $_SESSION['pseudo'] = $row['pseudo'];
        header('Location: user_space.php');

    }
    else {
        echo 'NOON';
    }
}
else if($action == 'Changer mot de passe')
{
    if( $_POST['ancienmdp'] === $_SESSION['password'] ){
        if($_POST['nouveaumdp'] ===  $_POST['confirmationmdp'] )
        {
            $query = 'UPDATE user SET mdp = \'' . $_POST['nouveaumdp'] .
                    '\' WHERE email = \'' . $_SESSION['mail'] . '\'';
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
            $_SESSION['changefail2'] = '';
            header('Location: user_space.php');
        }

    }
    else
    {
        $_SESSION['changefail1'] = '';
        header('Location: user_space.php');
    }
}
else if($action == 'Se déconnecter')
{
    $_SESSION = array();
    header('Location: user_space.php');
}
