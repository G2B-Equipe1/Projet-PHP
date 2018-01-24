<?php
require 'base.php';
session_start();
$action = $_POST['action'];

if($action == 'a_sign_in')
{
    if(!mysqli_num_rows(mysqli_query($dbLink, 'SELECT email FROM user WHERE email = \''. $_POST['mail']. '\''))
        && preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $_POST['mail'] ))
    {
        if(!mysqli_num_rows(mysqli_query($dbLink, 'SELECT email FROM user WHERE pseudo = \''. $_POST['pseudo']. '\'')))
        {
            if($_POST['mdp'] === $_POST['confirmationmdp'])
            {
                $_SESSION = array();
                $_SESSION['mailtemp'] = $_POST['mail'];
                $_SESSION['pseudotemp'] = $_POST['pseudo'];
                $_SESSION['mdptemp'] = $_POST['mdp'];
                $_SESSION["valid_until"] = time() + 60 * 5;
                header('Location: activate.php');
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
else if ($action == 'a_log_in')
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
        $_SESSION['connexionfailed'] = '';
        header('Location: user_space.php');
    }

    $row = mysqli_fetch_assoc($dbResult);
    if( md5($mdp) === $row['mdp'])
    {
        $_SESSION['id'] = $row['id'];
        $_SESSION['mail'] = $mail;
        $_SESSION['password'] = md5($mdp);
        $_SESSION['categorie'] = $row['categorie'];
        $_SESSION['pseudo'] = $row['pseudo'];
        header('Location: user_space.php');

    }
    else {
        $_SESSION['connexionfailed'] = '';
        header('Location: user_space.php');
    }
}
else if($action == 'a_change_password')
{
    if( md5($_POST['ancienmdp']) === $_SESSION['password'] ){
        if($_POST['nouveaumdp'] ===  $_POST['confirmationmdp'] )
        {
            $query = 'UPDATE user SET mdp = \'' . md5($_POST['nouveaumdp']) .
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
            $_SESSION['password'] = md5($_POST['nouveaumdp']);
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
else if($action == 'a_log_out')
{
    $lang = $_SESSION['lang'];
    $_SESSION = array();
    $_SESSION['lang'] = $lang;
    header('Location: user_space.php');
}
else if($action == 'a_delete_account')
{
    if(md5($_POST['mdp']) === $_SESSION['password'])
    {
        $query = 'DELETE FROM user WHERE email = \'' . $_SESSION['mail'] . '\'';
        if(!($dbResult = mysqli_query($dbLink, $query)))
        {
            echo 'Erreur dans requête<br />';
            // Affiche le type d'erreur.
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
            // Affiche la requête envoyée.
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }
        $_SESSION = array();
        echo 'Compte supprimé avec succès<br />';
        echo '<a href="index.php">Revenir à l\'acceuil</a>';
        exit();

    }
    else
    {
        $_SESSION['wrongmdp'] = '';
        header('Location: user_space.php');
    }
}
else if(preg_match('/^Passer /',$action) || preg_match('/^Change to /',$action))
{
    $pieces = explode(' ', $action);
    $cat = array_pop($pieces);

    $query = 'UPDATE user SET categorie = \'' . $cat .
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
    $_SESSION['categorie'] = $cat;
    header('Location: user_space.php');

}
else if($action == 'a_activate_account')
{
    if($_POST['code'] === $_POST['realcode'])
    {
        $today = date('Y-m-d');
        $query = 'INSERT INTO user (email, pseudo, mdp, date, categorie ) 
                      VALUES (\'' . $_POST['mail'] . '\', \'' . $_POST['pseudo'] . '\', \''
            . md5($_POST['mdp']) . '\', \'' . $today . '\', \'standard\' )';

        if(!($dbResult = mysqli_query($dbLink, $query)))
        {
            echo 'Erreur dans requête<br />';
            // Affiche le type d'erreur.
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
            // Affiche la requête envoyée.
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }
        $query = 'SELECT id FROM user WHERE mail=\'' . $_POST['mail'] . '\'';
        $dbResult = mysqli_query($dbLink, $query);
        $row = mysqli_fetch_assoc($dbResult);
        $_SESSION = array();
        $_SESSION['id'] = $row['id'];
        $_SESSION['mail'] = $_POST['mail'];
        $_SESSION['password'] = md5($_POST['mdp']);
        $_SESSION['pseudo'] = $_POST['pseudo'];
        $_SESSION['categorie'] = 'standard';
        $_SESSION['inscriptionreussie'] = '';
        setcookie('confirmail', $data_crypt, -1);
        header('Location: user_space.php');
    }
    else
    {
        $_SESSION['wrongcode'] = '';
        header('Location: activate.php');
    }


}
else if($action == 'a_cancel_activation')
{
    setcookie('confirmail', $data_crypt, -1);
    $_SESSION = array();
    header('Location: user_space.php');

}
else
{
    echo 'L\'action demandée n\'existe pas';
    exit();
}
