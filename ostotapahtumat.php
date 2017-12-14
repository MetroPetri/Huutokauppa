<div class="box">
<form method="post" enctype="multipart/form-data" action="ostotapahtumat.php">
    <input type="number" placeholder="€" name="tarjous" required>

    <input type="submit" name="laheta" value="Lähetä"/>
    <input type="submit" name="ostaheti" value="Ostaheti"/>
</form>
</div>
<?php
require_once('config/config.php');
$product_id = $_SESSION['sessionpid'];
echo $_POST['tarjous'];


try {


    $product_id = $_SESSION['sessionpid'];
    $ID = $_SESSION['ID'];
    $tarjous = $_POST["tarjous"];
    $ostaheti = $_POST['ostaheti'];
    $_tarjousilmoitus = "Tuotteestasi on tehty uusi tarjous";
    $_ostoilmoitus = " on ostettu suoraan.";

    $sql = "SELECT Myyja FROM Tuote WHERE Tuote.TuoteID = ".$product_id.";";
    $STH5 = $DBH->query($sql);
    $STH5->setFetchMode(PDO::FETCH_OBJ);
    $kohdeID = $STH5->fetch();
    $kohde = $kohdeID->Myyja;

    //$kohde = $_SESSION['kohdeID'];

    $sql = "SELECT Nimi FROM Tuote WHERE Tuote.TuoteID = ".$product_id.";";
    $STH5 = $DBH->query($sql);
    $STH5->setFetchMode(PDO::FETCH_OBJ);
    $tuotenimi = $STH5->fetch();
    $tuoote = $tuotenimi->Nimi;


    $_ostoilmoitus = $tuoote.$_ostoilmoitus;

    if (isset($_POST['tarjous'])) {

    $STH = $DBH->prepare('INSERT INTO Tarjous (Tuote, CountUs, TarjoajaID)
                                    VALUES (:tuote, :tarjous, :tarjoaja);');
    $STH->bindParam(":tuote", $product_id);
    $STH->bindParam(":tarjous", $tarjous);
    $STH->bindParam(':tarjoaja', $ID);
    if($STH->execute()){

        $STH2 = $DBH->prepare('UPDATE Tuote SET Hinta = :tarjous

			WHERE TuoteID = :tuote  AND Hinta < :tarjous AND Ostaheti > :tarjous;');
        $STH2->bindParam(':tarjous', $tarjous);
        $STH2->bindParam(":tuote", $product_id);
        $STH2->execute();
        $STH6 = $DBH->prepare('INSERT INTO Ilmoitukset (Ilmoitus, Kohde)
                                    VALUES (:ilmotus, :kohde);');
        $STH6->bindParam(":kohde", $kohde);
        $STH6->bindParam(":ilmotus", $_tarjousilmoitus);
        $STH6->execute();
        redirect("product.php?id=$product_id");

    }}
    if (isset($_POST['ostaheti'])) {
       /* $sql = "SELECT *
        FROM User, Tuote
        WHERE Tuote.TuoteID = $product_id AND User.ID = Tuote.Myyja";

//Testi, miltä lause näyttää - lainausmerkit kohdallaan?
//echo($sql);
        echo("</br>");
        $kysely = $DBH->prepare($sql);

        $kysely->execute();

        try{
            while ($myyja = $kysely->fetch()) {
                $myyjat[]=$myyja;



            }

        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
        for ($i = 0; $i < count($myyjat); $i++) {
            $yhteys = $myyjat[$i]["Email"];
            return $yhteys;
        }
        echo "haloo";
        echo $yhteys;*/
        $STH7 = $DBH->prepare('INSERT INTO Ilmoitukset (Ilmoitus, Kohde)
                                    VALUES (:osto, :kohde);');
        $STH7->bindParam(":kohde", $kohde);
        $STH7->bindParam(":osto", $_ostoilmoitus);
        $STH7->execute();
            $STH4 = $DBH->prepare('DELETE FROM Tarjous
WHERE Tarjous.Tuote = :tuote');
            $STH4->bindParam(":tuote", $product_id);
            $STH4->execute();
        $STH3 = $DBH->prepare('DELETE FROM Tuote
WHERE Tuote.TuoteID = :tuote');
        $STH3->bindParam(":tuote", $product_id);
        $STH3->execute();

            redirect("product.php?id=$product_id");


    }

} catch(PDOException $e) {	echo $e.$product_id;}
?>