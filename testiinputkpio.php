<?php
session_start();
require_once('config/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<p></p>
    <form name="upForm" class="modal-content animate" action="upload.php" method="post" enctype="multipart/form-data">
        <div class="imgcontainer">
            <img src="img/hammer.png" alt="Avatar" class="avatar">
        </div>

      <div class="container">
            <label><b>Nimeä ilmoituksesi</b></label>
            <input type="text" placeholder="Tuote" name="data[tuote]" required>

            <label><b>Kategoria</b></label>
            <div type="">

                <?php

                $query = $DBH->query("SELECT * FROM Tuotekategoria");

                echo '<select name="kategoria">';

                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$row['KategoriaID'].'">'.$row['Kategoria'].'</option>';
                }

                echo '</select>';
                ?>

            </div>

            <label><b>Alakategoria</b></label>
            <div type="">
                <?php

                if( isset($_POST["kategoria"])){

                    $query = $DBH->query("SELECT ".$_POST["kategoria"]." FROM Alakategoria"); // Run your query

                echo '<select name="data[alakategoria]">'; // Open your drop down box

                // Loop through the query results, outputing the options one by one
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$row['AlakategoriaID'].'">'.$row['Nimi'].'</option>';
                }

                echo '</select>';// Close your drop down box
                }
                ?>
            </div>

            <label><b>Lähtöhinta</b></label>
            <input type="number" placeholder="€" name="data[lahtohinta]" required>

            <!--<label><b>Sijainti</b></label>
            <input type="text" placeholder="Sijainti" name="data[sijainti]" required>-->

            <label><b>Kunto</b></label>
            <div type="">
                <?php


                    $query = $DBH->query("SELECT * FROM Kunto"); // Run your query

                echo '<select name="data[kunto]">'; // Open your drop down box

                // Loop through the query results, outputing the options one by one
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$row['ID'].'">'.$row['Arvo'].'</option>';
                }

                echo '</select>';// Close your drop down box
                ?>
            </div>


            <label><b>Buyout</b></label>
            <input type="number" placeholder="€" name="data[ostaheti]" required>

            <label><b>Takaraja</b></label>
            <input type="text" placeholder="YYYY-MM-DD HH:MI:SS" name="data[takaraja]" required pattern="\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}:\d{2}">

            <label><b>Kuvaus</b></label>
            <input type="text" placeholder="Tuotteen kuvaus..." name="data[kuvaus]" required>

            <label><b>Kuva</b>></label>
            <input type="file" name="data[file]" id="fileUp">
            <input type="submit" value="Aseta myynti-ilmoitus">



        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('register').style.display='none'" class="cancelbtn">Poistu</button>
        </div>
    </form>
<script src="upload.js"></script>



</body>
</html>