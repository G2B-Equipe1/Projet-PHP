<?php
require_once 'base.php';
if($_POST['pass'] != $_POST['pass2']) {
    $verifPasswrds = 'badPasswrds';
}
else {
    $token = $_GET['token'];
    $queryToken = 'SELECT * FROM tokens WHERE token = \'' . $_GET['token'] . '\'';
    if(!($result = mysqli_query($dbLink, $queryToken)))
        echo 'La requete token a foiré.';
    $result = mysqli_fetch_assoc($result);
    if(time() >= $result['expire']) {
        $queryDropToken = 'DELETE FROM tokens WHERE id = \'' . $result['id'] . '\'';
        if(!($resultDrop = mysqli_query($dbLink, $queryDropToken)))
            echo 'La requete de suppression du token a foiré.';
        $verifPasswrds = 'timeOut';
    }
    else {
        $verifPasswrds = 'goodPasswrds';
        $newPasswrd = md5($_POST['pass']);
        $idUser = $result['idUser'];
        echo $newPasswrd, $idUser;
        $queryChangePasswrd = 'UPDATE user SET mdp = \'' . $newPasswrd . '\' WHERE id = \'' . $idUser . '\'';
        if(!($result = mysqli_query($dbLink, $queryChangePasswrd)))
            echo 'La requete de modification de mot de passe a echoué.';
        $queryDropToken = 'DELETE FROM tokens WHERE id = \'' . $result['id'] . '\'';
        if(!($resultDrop = mysqli_query($dbLink, $queryDropToken)))
            echo 'La requete de suppression du token a foiré.';
    }
}
if($verifPasswrds == 'goodPasswrds')
    header('location: index.php');
else
    header('Location: edit_password.php?token=' . $token . '&verifPasswrds=' . $verifPasswrds);