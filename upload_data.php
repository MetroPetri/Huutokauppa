<?php
require_once('config/config.php');
//session_start();
// print_r($_SESSION);
try {
    $ID = $_SESSION['ID'];
    $STH2 = $DBH->prepare("INSERT INTO Tuote (Nimi, Ostaheti, EndDate, Myyja, Kuva, Kuvaus, Kunto, Alakategoria, Hinta)

			VALUES (:tuote, :ostaheti, :takaraja, :myyja, :file, :kuvaus, :kunto, :kategoria, :lahtohinta);");
    $STH2->bindParam(':file', $_POST['filename']);
    $STH2->bindParam(':tuote', $_POST['tuote']);
    $STH2->bindParam(':lahtohinta', $_POST['lahtohinta']);
    $STH2->bindParam(':ostaheti', $_POST['ostaheti']);
    $STH2->bindParam(':takaraja', $_POST['takaraja']);
    $STH2->bindParam(':kuvaus', $_POST['kuvaus']);
    $STH2->bindParam(':kunto', $_POST['kunto']);
    $STH2->bindParam(':kategoria', $_POST['kategoria']);
    $STH2->bindParam(':myyja', $ID);
    // echo $ID;
    if($STH2->execute())
            echo 'toimii';
} catch(PDOException $e) {	echo $e;}