<?php
//echo $_SESSION['sahkoposti'];
$product_id = $_SESSION['sessionpid'];
    //KOMMENTOINTIINPUT SAATTAA OLLA SITTEN VAAN PLACEHOLDERI, NIMETKI MENI NYT TOISINPÄIN MUTTA EI SIITÄ PIDÄ HÄMÄÄNTYÄ

    ?>

<form method="post" enctype="multipart/form-data" action="kommenttiintput.php">
    <input type="text" placeholder="Otsikko" name="otsikko" required>
    <input type="text" placeholder="Kommentti..." name="kommentti"/><br>
    <input type="submit" value="Lähetä"/>
</form>
