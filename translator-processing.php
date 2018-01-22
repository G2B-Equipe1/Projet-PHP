<?php
require 'base.php';
session_start();
$action = $_POST['action'];

if($action == "export") {
    $filename = "lang/" . $_POST['language'] . ".po";
    $handle = fopen($filename, 'w+');
    $head = "msgid \"\"
msgstr \"\"
\"Project-Id-Version: \\n\"
\"POT-Creation-Date: \\n\"
\"PO-Revision-Date: \\n\"
\"Last-Translator: \\n\"
\"Language-Team: \\n\"
\"Language: " . $_POST['language'] . "\\n\"
\"MIME-Version: 1.0\\n\"
\"Content-Type: text/plain; charset=UTF-8\\n\"
\"Content-Transfer-Encoding: 8bit\\n\"\n\n";
    fwrite ($handle, $head);
    $translations = mysqli_query($dbLink, 'SELECT word, translation FROM translation WHERE lang= "' . $_POST["language"] . '"');
    while ($row = mysqli_fetch_assoc($translations)) {
        $trad = 'msgid "' . $row['word'] . "\"\nmsgstr \"" . $row['translation'] . "\"\n\n" ;
        fwrite ($handle, $trad);
    }
    fclose($handle);
    $_SESSION['tradfilename'] = $filename;
    header('Location: translator.php');
}

