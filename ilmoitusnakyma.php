<div class="box">
<h3>Tuotteen kommentit:</h3>
<?php
require_once("config/config.php");
$product_id = $_SESSION['sessionpid'];

$sql = "SELECT *
        FROM User ,Tarjous, Tuote
        WHERE User.ID = Tarjous.TarjoajaID AND Tarjous.Tuote = $product_id AND Tarjous.CountUS = Tuote.Hinta";

 //Testi, miltä lause näyttää - lainausmerkit kohdallaan?
//echo($sql);
$kysely = $DBH->prepare($sql);

$kysely->execute();
//kuvia varten kansio

try{
    while ($tarjous = $kysely->fetch()) {

        $t=$tarjous;

        echo '<td>'."Korkein tarjous:"." ".$tarjous['Email']." ".$tarjous['Hinta'].'</td>';
    }

} catch (PDOException $e) {
    die("VIRHE: " . $e->getMessage());
}
?>

<?php

$sql = "SELECT *
        FROM User, Tuote, Kommentti
        WHERE Kommentti.Tuote = $product_id AND User.ID = Kommentti.Kommentoija AND Tuote.TuoteID = $product_id";

//Testi, miltä lause näyttää - lainausmerkit kohdallaan?
//echo($sql);
echo("</br>");
$kysely = $DBH->prepare($sql);

$kysely->execute();

    try{
    while ($kommentti = $kysely->fetch()) {
   $kommentit[]=$kommentti;
    $k=$kommentti;

    }

   } catch (PDOException $e) {
   die("VIRHE: " . $e->getMessage());
    }
for ($i = 0; $i < count($kommentit); $i++) {
   echo '<h3>' . $kommentit[$i]["Kommenttiotsikko"] . '</h3>
            <p>' . $kommentit[$i]["Kommentti"] . '</p>
             <p>'. $kommentit[$i]["Email"] . '</p>';
}


// TÄÄ ON VARMAAN PASKAA
?>
</div>
