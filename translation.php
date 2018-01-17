<?php
include 'util.php';
start_page();
nav_bar();
?>
        <form action="#" method="get">
            <select name="from">
                <option>Français</option>
                <option>Anglais</option>
            </select>
            <input type="text" name="to_translate"/>
            <select name="to">
                <option>Anglais</option>
                <option>Français</option>
            </select>
            <input type="submit" name="action" value="translate"/>
        </form>

<?php
footer();
end_page();
?>
