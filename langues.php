<?php
function set_options ($selectedlang) {

    $query = 'SELECT DISTINCT lang
              FROM translation' ;

    if(!($dbResult = mysqli_query($GLOBALS['dbLink'], $query)))
    {
        echo 'Erreur dans requête<br />';
// Affiche le type d'erreur.
        echo 'Erreur : ' . mysqli_error($GLOBALS['dbLink']) . '<br/>';
// Affiche la requête envoyée.
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }

    echo '<option value="english">' . ($_SESSION['lang'] == 'en_US' ? 'english' : 'anglais' ) . '</option>';
    while ($dbRow = mysqli_fetch_assoc($dbResult))
    {
        $query = 'SELECT word, translation
              FROM translation
              WHERE word = \'' . $dbRow['lang'] . '\' AND lang=\'french\'';
        $rowLang = mysqli_fetch_assoc(mysqli_query($GLOBALS['dbLink'], $query));
        echo '<option value="' . $dbRow['lang'] . '"'
            . ($selectedlang == $dbRow['lang'] ?  'selected' : '') . '>' .
            ($_SESSION['lang'] == 'en_US' ? $rowLang['word'] : $rowLang['translation'] )  .  ' </option> ';
    }
}
function set_word ($word) {
    if (isset($word)) {
        echo 'value="'.$word.'"';
    } else {
        return;
    }
}

function form_insert_word($word, $from, $to){
    ?><form action="get_translation-processing.php" method="post">
        Mot en  <?= $from ?> :
        <input type="hidden" name="from" value="<?= $from ?>">
        <input type="text" name="to_translate" <?=  set_word($word) ?>/>
        Traduction dans la langue
        <?php   ( $_SESSION['modiftrad'] ?   : $select = true);
        if ($select) { ?>
        <select name="to">
            <?= set_options($to); ?>
        </select>
         <?php } else echo $_SESSION['to']; ?>
          :
        <input type="text" name="translation"/>
        <?php echo ($_SESSION['modiftrad'] ? '<input type="submit" name="action" value="Modifier traduction"/>' :
        ($_SESSION['simpletrad'] ? '<input type="submit" name="action" value="New translation"/>' :
            ($_SESSION['firsttrad'] ? '<input type="submit" name="action" value="Première étape"/>' :
                '<input type="submit" name="action" value="Seconde étape"/>' )) )  ?>
    </form>
<?php
}

function check_requests(){
    $query = 'SELECT *
          FROM translation_request
          WHERE state=\'en cours\'';
    $dbResult = mysqli_query($GLOBALS['dbLink'], $query);
    while ($dbRow = mysqli_fetch_assoc($dbResult)){
        if($dbRow['from_lang'] == 'english'){
            $query = 'SELECT *
              FROM translation
              WHERE word=\''.$dbRow['word'].'\' AND lang=\'' . $dbRow['to_lang'] . '\'';
            $dbResult1 = mysqli_query($GLOBALS['dbLink'], $query);
            if(mysqli_num_rows($dbResult1) > 0){
                $query = 'UPDATE translation_request SET state = \'traduit\' WHERE id = \'' . $dbRow['id'] . '\'';
                mysqli_query($GLOBALS['dbLink'], $query);
            }
        }
        if($dbRow['to_lang'] == 'english'){
            $query = 'SELECT *
              FROM translation
              WHERE translation=\''.$dbRow['word'].'\' AND lang=\'' . $dbRow['from_lang'] . '\'';
            $dbResult1 = mysqli_query($GLOBALS['dbLink'], $query);
            if(mysqli_num_rows($dbResult1) > 0){
                $query = 'UPDATE translation_request SET state = \'traduit\' WHERE id = \'' . $dbRow['id'] . '\'';
                mysqli_query($GLOBALS['dbLink'], $query);
            }
        }
        else {
            $query = 'SELECT word
              FROM translation
              WHERE translation=\''.$dbRow['word'].'\' AND lang=\'' . $dbRow['from_lang'] . '\'';
            $dbResult1 = mysqli_query($GLOBALS['dbLink'], $query);
            if($dbRow1 = mysqli_fetch_assoc($dbResult1)){
                $query = 'SELECT *
                FROM translation
                WHERE word=\''.$dbRow1['word'].'\' AND lang=\'' . $dbRow['to_lang'] . '\'';
                $dbResult2 = mysqli_query($GLOBALS['dbLink'], $query);
                if(mysqli_num_rows($dbResult2) > 0){
                    $query = 'UPDATE translation_request SET state = \'traduit\' WHERE id = \'' . $dbRow['id'] . '\'';
                    mysqli_query($GLOBALS['dbLink'], $query);}
            }



        }

    }
}
