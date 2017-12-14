<?php

require_once('config/config.php');
SSLon();
$STH = $DBH->prepare("SELECT * FROM User WHERE User.Email = '{$_SESSION['sahkoposti']}' ");
$STH->execute();
$userID = $STH->fetch(PDO::FETCH_ASSOC);

$STH2 = $DBH->prepare('UPDATE Log SET ulos = NOW()

			WHERE ulos IS NULL AND kayttaja = :kayttis;');
$STH2->bindParam(":kayttis", $userID['ID']);
$STH2->execute();

session_destroy();  //tuhoa sessio!
redirect(SITE_ROOT); //siirry kotisivulle
?>