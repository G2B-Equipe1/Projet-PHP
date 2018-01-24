<?php
include 'util.php';
start_page();
nav_bar();
require 'recaptchalib.php';
$siteKey = '6LezG0EUAAAAAL0VeS0SwgOaO0bFQLa0dTjmEgE2'; // votre clé publique
$secret = '6LezG0EUAAAAAOvt1kWCqSIHMecBhbyW8QowMBC8'; // votre clé privée
?>
    <form method="post" action="traitement.php">
        <p>
            <label for="ameliorer">Comment pensez-vous que je pourrais améliorer mon site ?</label><br />
            <textarea name="ameliorer" id="ameliorer"></textarea>
        </p>
        <<?php
    $reCaptcha = new ReCaptcha($secret);
    if(isset($_POST["g-recaptcha-response"])) {
        $resp = $reCaptcha->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $_POST["g-recaptcha-response"]
        );
        if ($resp != null && $resp->success) {echo "OK";}
        else {echo "CAPTCHA incorrect";}
    }
    ?>
    <form action="test-captcha.php" method="POST">
        <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
    </form>
        <input type="submit" value="envoyer">
    </form>
<?php
end_page();
?>