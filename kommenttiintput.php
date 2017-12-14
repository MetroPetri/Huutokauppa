<?php
require_once('config/config.php');
$product_id = $_SESSION['pillu'];
try {
//Tuotteesta tulee vielä luoda erikseen sessio tämän



    $otsikko = $_POST ["otsikko"];
    $kommentti = $_POST ["kommentti"];
    /*$ID = $_SESSION['ID'];*/
    $product_id = $_SESSION['sessionpid'];

    $STH = $DBH->prepare("SELECT * FROM User WHERE User.Email = '{$_SESSION['sahkoposti']}' ");
    $STH->execute();
    $kommentointiID = $STH->fetch(PDO::FETCH_ASSOC);



    $kommentoija = $_SESSION['sahkoposti'];
    $kommenttiilmoitus = " kommentoi ilmoitustasi";

    $kommenttiilmoitus = $kommentoija.$kommenttiilmoitus;
    $sql = "SELECT Myyja FROM Tuote WHERE Tuote.TuoteID = ".$product_id.";";
    $STH5 = $DBH->query($sql);
    $STH5->setFetchMode(PDO::FETCH_OBJ);
    $kohdeID = $STH5->fetch();
    $kohde = $kohdeID->Myyja;

    $STH2 = $DBH->prepare('INSERT INTO Kommentti (Kommentti, Kommentoija, Kommenttiotsikko, Tuote)
                                    VALUES (:kommentti, :kommentoija, :otsikko, :tuote);');
    $STH2->bindParam(":otsikko", $otsikko);
    $STH2->bindParam(":kommentti", $kommentti);
    $STH2->bindParam(":kommentoija", $kommentointiID['ID']);
    $STH2->bindParam(":tuote", $product_id);
    if ($STH2->execute()) {

        $sql = "SELECT * FROM Kommentti WHERE ID = ".$DBH->lastInsertId().";";
        $STH5 = $DBH->query($sql);
        $STH5->setFetchMode(PDO::FETCH_OBJ);
        $kommentinID = $STH5->fetch();
        $_SESSION['kommentinID'] = $kommentinID->ID;

        $iid = $_SESSION['kommentinID'];

        //$STH4 = $DBH->prepare("SELECT * FROM Kommentti WHERE Kommentti.Kommentoija = '{$ID}'  AND ID = '{$iid}' ");
        //$STH4->execute();
        //$kommenttiiID = $STH->fetch(PDO::FETCH_ASSOC);
//vanha versio \
        $STH3 = $DBH->prepare("UPDATE Tuote 
                                    SET Kommentti = :kommenttii 
                                    WHERE TuoteID = '{$product_id}' ;");
        $STH3->bindParam(":kommenttii", $iid);
        $STH3->execute();
        $STH6 = $DBH->prepare('INSERT INTO Ilmoitukset (Ilmoitus, Kohde)
                                    VALUES (:ilmotus, :kohde);');
        $STH6->bindParam(":kohde", $kohde);
        $STH6->bindParam(":ilmotus", $kommenttiilmoitus);
        $STH6->execute();

        redirect("product.php?id=$product_id");

    }


} catch(PDOException $e) {	echo 'yhyyy.';}
/*
 $sql = "SELECT * FROM User WHERE ID = ".$DBH->lastInsertId().";";
$STH3 = $DBH->query($sql);
$STH3->setFetchMode(PDO::FETCH_OBJ);
$user = $STH3->fetch();
$_SESSION['kirjautunut'] = 'yes';
$_SESSION['etunimi'] = $user->Nimi;
$kommenttiiID['ID']
 */
?>
