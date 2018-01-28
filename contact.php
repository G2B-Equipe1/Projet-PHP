<?php
session_start();
include_once 'vues/util.php';

start_page();
nav_bar();
include_once 'recaptchalib.php';
$siteKey = '6LezG0EUAAAAAL0VeS0SwgOaO0bFQLa0dTjmEgE2'; // votre clé publique
$secret = '6LezG0EUAAAAAOvt1kWCqSIHMecBhbyW8QowMBC8'; // votre clé privée


$reCaptcha = new ReCaptcha($secret);
if(isset($_POST["g-recaptcha-response"])) {
    $resp = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
    if ($resp != null && $resp->success) {echo "OK";}
    else {echo "CAPTCHA incorrect";}
}?>

    <form action="contact.php" method="POST">
        <input type="hidden" name="mail" value="<?php echo $_POST["mail"]?>"/>
        <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
        <input type="submit" value="Valider">
    </form>

<?php
if ($resp != null && $resp->success) {?>
    <form method="post" action="contact-processing.php">
        <h3>Contacter <?php echo $_POST["mail"]?></h3><br/>
        <input type="hidden" name="mail" value="<?php echo $_POST["mail"]?>"/>
        <label for="ameliorer">Comment pensez-vous que je pourrais améliorer mon site ?</label><br />
        <textarea name="ameliorer" id="ameliorer"></textarea>
        <input type="submit" value="envoyer">
    </form>
<?php }

echo '<a href="about.php">Retour</a>';

end_page();
?>