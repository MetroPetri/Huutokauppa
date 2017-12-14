<?php
require_once('config/config.php');

require_once ('views/header.php');
?>


<section id="showcase">
    <div class="container">
        <h1>Hakutulokset</h1>
    </div>
</section>

<div class="maincontainer">
    <?php
    require_once('views/asideleft.php');
    ?>

    <?php
    if(isset($_POST["Soittimet"])){
        $haku = "Soittimet";
    }
    if(isset($_POST["Ajoneuvot"])){
        $haku = "Ajoneuvot";
    }
    if(isset($_POST["Tietotekniikka"])){
        $haku = "Tietotekniikka";
    }
    if(isset($_POST["Harrastukset"])){
        $haku = "Harrastukset";
    }
    if(isset($_POST["Sekalaista"])){
        $haku = "Sekalaista";
    }


    $sql = "SELECT * 
FROM Tuote, Tuotekategoria
WHERE Tuotekategoria.Kategoria = '{$haku}' AND Tuotekategoria.KategoriaID = Tuote.Alakategoria";

    $pienikysely = $DBH->prepare($sql);

    $pienikysely->execute();

    while ($rivi = $pienikysely->fetch()) {
        $rivit[]=$rivi;
        $s = $rivi["Kuva"];}

    try{
        while ($rivi = $pienikysely->fetch()) {
            echo"<br /> " .htmlspecialchars($rivi["Nimi"]) . "  " .$rivi["Hinta"] .
                " </br> -";
        }

    } catch (PDOException $e) {
        die("VIRHE: " . $e->getMessage());
    }
    ?>


    <section id="boxes">
        <div class="container">
            <?php
            for ($i=0;$i<count($rivit);$i++){
                echo'<div class="box"><a href="product.php?id='.$rivit[$i]["TuoteID"].'"><img src="'.$rivit[$i]["Kuva"].'"><h3>"'.$rivit[$i]["Nimi"].'"</h3>
            <p>"'.$rivit[$i]["Kuvaus"].'"</p></div>';

            }
            ?>

        </div>
    </section>

    <?php
    require_once('views/asideright.php');
    ?>

</div>
<?php
require_once('views/end.php');
?>





