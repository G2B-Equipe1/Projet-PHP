<?php
include_once 'vues/util.php';
include_once 'vues/activate.php';
session_start();
if(!isset($_COOKIE['confirmail']))
{
    if(!isset($_SESSION['mailtemp']) || $_SESSION['valid_until'] < time())
    {
        setcookie('confirmail', $data_crypt, -1);
        $_SESSION = array();
        header('Location: user_space.php');
    }
    $code = str_shuffle(uniqid());
    $data = $_SESSION['mailtemp'] . '|' . $_SESSION['pseudotemp'] . '|' . $_SESSION['mdptemp'] . '|' . $code ;
    $cipher = "aes-128-gcm";
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $data_crypt = openssl_encrypt($data, $cipher, 'datacookie', $options=0, $iv, $tag);
    $_SESSION['iv'] = $iv;
    $_SESSION['tag'] = $tag;
    setcookie('confirmail', $data_crypt, time() + 60 * 5);
    confirm_mail($_SESSION['mailtemp'], $_SESSION['pseudotemp'], $code );
    header('Location: activate.php');
}
$data_decrypt = openssl_decrypt ( $_COOKIE['confirmail'] , "aes-128-gcm" , 'datacookie',
                                    $options=0, $_SESSION['iv'], $_SESSION['tag'] );
$pieces = explode('|', $data_decrypt);
$code = array_pop($pieces);
$mdp = array_pop($pieces);
$pseudo = array_pop($pieces);
$mail = array_pop($pieces);
session_start();
start_page();
nav_bar();

echo 'Vous avez reçu un mail contenant un code valable 5 minutes pour activer votre compte. Si vous n\'avez pas activé
votre compte dans ce temps, vous devrez réitérer l\'inscription.';

activation($code, $mail, $pseudo, $mdp);

?>
<p style="display:<?php echo isset($_SESSION['wrongcode']) ? '' : 'none';
unset($_SESSION['wrongcode']) ?>;">
    Le code d'activation est incorrect.
</p>

<?php annuler();



