<?php
require_once('config/config.php');
require_once('views/header.php');
?>

<section id="showcase">
    <div class="container">
        <h1>Tarkempi haku</h1>

    </div>
</section>
<div class="hakucontainer">
    <?php
    require_once('views/asideleft.php');
    ?>

<section id="hakusection">
    <div class="hakucontainer">

        <form id="tarkempihaku" class="haku" method="POST">
            <label><b>Hakusana</b></label>
            <input type="text" placeholder="Hae..." name="avainsana" required>

            <label><b>Hintahaarukka</b></label>
            <input type="number" placeholder="Min. hinta €" name="minhinta" required>
            <input type="number" placeholder="Max. hinta €" name="maxhinta"/><br>
            <button class="button" type="submit" value="Etsi">Etsi</button>
            <button class="button" type="reset" value="Resetoi">Resetoi</button>

        </form>
        <?php

        $haku = $_POST["avainsana"];
        $minhinta = $_POST["minhinta"];
        $maxhinta = $_POST["maxhinta"];

        if( isset($_POST["avainsana"])) {
            //echo("<p> $haku -alkuiset tuotteet hintahaarukalla $minhinta - $maxhinta euroa. </p>");
            $sql = "SELECT *
        FROM Tuote
        WHERE Tuote.Nimi LIKE " . "'" . $haku . "%' AND Tuote.Hinta
        BETWEEN " . $minhinta . " AND " . $maxhinta . "";


            //echo($sql); //Testi, miltä lause näyttää - lainausmerkit kohdallaan?
            //echo("</br>");
            $kysely = $DBH->prepare($sql);

            $kysely->execute();
            //kuvia varten kansio                               !


            while ($rivi = $kysely->fetch()) {
                $rivit[]=$rivi;
                $s = $rivi["Kuva"];
                $id = $rivi["TuoteID"];


                //echo "<a href='http://www.iltalehti.fi/'  /> <img src='uploads/$s' a
               // lt='TOIMINYT' width='42' height='42'> " . htmlspecialchars($rivi["Nimi"]) . "  " . $rivi["Hinta"] . "€" .
                  //  " <a></br> ";
            }
        }
        ?>
    </div>

    <section id="hakuboxes">
        <div class="container">
            <?php
            for ($i=0;$i<count($rivit);$i++){
                echo'<div class="box"><a href="product.php?id='.$rivit[$i]["TuoteID"].'"><img src="'.$rivit[$i]["Kuva"].'"><h3>"'.$rivit[$i]["Nimi"].'"</h3>
            <p>"'.$rivit[$i]["Kuvaus"].'"</p></div>';

            }



            ?>

            <!--<div class="box"><img src="DATABASEKUVA"><h3>Tuotteen nimi XXXXXXX</h3>
                <p>Tuottenen tiedot XXXX</p></div>
            <div class="box"><img src="DATABASEKUVA"><h3>Tuotteen nimi XXXXXXX</h3>
                <p>Tuottenen tiedot XXXX</p>
            </div>
            <div class="box">
                <img src="DATABASEKUVA">
                <h3>
                    Tuotteen nimi XXXXXXX
                </h3>
                <p>
                    Tuottenen tiedot XXXX
                </p>
            </div>
            <div class="box">
                <img src="DATABASEKUVA">
                <h3>
                    Tuotteen nimi XXXXXXX
                </h3>
                <p>
                    Tuottenen tiedot XXXX
                </p>
            </div>-->
        </div>
        </section>
</section>

    <?php
    require_once('views/asideright.php');
    ?>

    <section id="boxes">
    </section>

</div>
<?php
require_once('views/end.php');
?>
