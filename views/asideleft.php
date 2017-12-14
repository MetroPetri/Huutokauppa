<aside id="left">

    <div class="kategoriat" id="kategoriat">
        <h2>Kategoriat
        </h2>
        <form action="kategoria.php" method="post">
        <input type="submit" name="Soittimet" value="Soittimet"/>
        <input type="submit" name="Ajoneuvot" value="Ajoneuvot"/>
        <input type="submit" name="Tietotekniikka" value="Tietotekniikka"/>
        <input type="submit" name="Harrastukset" value="Harrastukset"/>
        <input type="submit" name="Sekalaista" value="Sekalaista"/>
        </form>
    </div>

    <!--<div class="paikkakunnat" id="paikkakunnat">
        <?php/*

        $query = $DBH->query("SELECT * FROM Sijainti"); // Run your query

        echo '<select id="kunta" name="data[sijainti]">'; // Open your drop down box

        // Loop through the query results, outputing the options one by one
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $row['SijaintiID'] . '">' . $row['Maakunta'] . '</option>';
        }
        $sql = "SELECT * 
        FROM Tuote, Tuotekategoria
          WHERE Tuotekategoria.Kategoria = '{$haku}' AND Tuotekategoria.KategoriaID = Tuote.Alakategoria";

        echo '</select>';// Close your drop down box
        */?>

    </div>-->
    <div class="ilmotus" id="ilmoitukset">
        <h2>Ilmoitukset</h2>
        <?php
        $ID = $_SESSION['ID'];
        $sql = "SELECT *
        FROM Ilmoitukset
        WHERE Kohde = '$ID' AND Aika >= CURRENT_DATE ";

        //Testi, miltä lause näyttää - lainausmerkit kohdallaan?
        //echo($sql);
        echo("</br>");
        $kysely = $DBH->prepare($sql);

        $kysely->execute();

        try{
            while ($ilmoytus = $kysely->fetch()) {
                $ilmoytukset[]=$ilmoytus;
                $k=$ilmoytus;


            }

        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
        for ($i = 0; $i < count($ilmoytukset); $i++) {
            echo '<h4>' . $ilmoytukset[$i]["Ilmoitus"] . '</h4>';
        }


        // TÄÄ ON VARMAAN PASKAA
        ?>
    </div>

</aside>