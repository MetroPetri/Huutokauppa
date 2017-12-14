<?php
require_once('config/config.php');
?>

      <div id="upload" class="hidden">
          <span class="close" title="Close Modal">&times;</span>
          <form name="upForm" class="modal-content animate" action="upload.php" method="post" enctype="multipart/form-data">
              <div class="imgcontainer">
                  <img src="img/hammer.png" alt="Avatar" class="avatar">
              </div>
            <label><b>Nimeä ilmoituksesi</b></label>
            <input type="text" placeholder="Tuote" name="tuote" required>

            <label><b>Kategoria</b></label>
            <div type="">

                <?php

                $query1 = $DBH->query("SELECT * FROM Tuotekategoria");

                echo '<select name="kategoria">';


                while ($row1 = $query1->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row1['KategoriaID'] . '">' . $row1['Kategoria'] . '</option>';
                }

                echo '</select>';
                ?>



            <label><b>Lähtöhinta</b></label>
            <input type="number" placeholder="€" name="lahtohinta" required>

            <!--<label><b>Sijainti</b></label>
            <input type="text" placeholder="Sijainti" name="sijainti" required>-->

            <label><b>Kunto</b></label>
            <div type="">
                <?php


                    $query = $DBH->query("SELECT * FROM Kunto"); // Run your query

                echo '<select name="kunto">'; // Open your drop down box

                // Loop through the query results, outputing the options one by one
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['ID'] . '">' . $row['Arvo'] . '</option>';
                }

                echo '</select>';// Close your drop down box
                ?>
            </div>


            <label><b>Buyout</b></label>
            <input type="number" placeholder="€" name="ostaheti" required>

            <label><b>Takaraja</b></label>
            <input type="text" placeholder="YYYY-MM-DD HH:MI:SS" name="takaraja" required pattern="\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}:\d{2}">

            <label><b>Kuvaus</b></label>
            <input type="text" placeholder="Tuotteen kuvaus..." name="kuvaus" required>


            <label><b>Kuva</b>></label>
            <input type="file" name="file" id="fileUp">
            <input type="submit" value="Aseta myynti-ilmoitus">
                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" onclick="document.getElementById('register').style.display='none'" class="cancelbtn">Poistu</button>
                </div>

          </form>
        </div>



<script src="upload.js"></script>
