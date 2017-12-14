<?php
require_once('config/config.php');

SSLon();

$userdata = unserialize($_SESSION['lomakedata']);  //tekstimuodosta takaisin taulukoksi
$data['sähköposti'] = $userdata['sähköposti'];

try {
    $STH = $DBH->prepare('SELECT * FROM User WHERE Email = :sahkoposti');
    echo('testi 1');
    $STH->bindParam(':sahkoposti', $userdata['sähköposti']);
    $STH->execute();
    echo('testi 2');
    $row = $STH->fetch();  //Löytyiko sama email osoite?
    if($STH->rowCount() == 0){ //Jos ei niin rekisteröidään
        // lisää suola '!!'
        $userdata['pwd'] = md5($userdata['pwd'].'!!');  //hashataan salasana suolalla
        print_r($userdata);
        echo('testi 3');
        try {
            echo('testi 4');
            $STH2 = $DBH->prepare('INSERT INTO User (Nimi, Sukunimi, Email, Sijainti, Salasana)

			VALUES (:etunimi, :sukunimi, :sahkoposti, :sijainti, :pwd);');
            $STH2->bindParam(':etunimi', $userdata['etunimi']);
            $STH2->bindParam(':sukunimi', $userdata['sukunimi']);
            $STH2->bindParam(':sahkoposti', $userdata['sähköposti']);
            $STH2->bindParam(':sijainti', $userdata['sijainti']);
            $STH2->bindParam(':pwd', $userdata['pwd']);
            echo('testi 5');
            if($STH2->execute()){
                try {
                    echo('testi 6');
                    //Jos käyttäjän tallennus onnistui asetetaan hänet loggautuneeksi
                    //eli kirjoitetaan käyttäjätiedot myös sessiomuuttujiin
                    $sql = "SELECT * FROM User WHERE ID = ".$DBH->lastInsertId().";";
                    $STH3 = $DBH->query($sql);
                    $STH3->setFetchMode(PDO::FETCH_OBJ);
                    $user = $STH3->fetch();
                    $_SESSION['kirjautunut'] = 'yes';
                    $_SESSION['etunimi'] = $user->Nimi;
                    $_SESSION['sukunimi'] = $user->Sukunimi;
                    $_SESSION['sijainti'] = $user->Sijainti;
                    $_SESSION['sähköposti'] = $user->Email;
                    $_SESSION['ID'] = $user->ID;
                    redirect("index.php");  //Palaa heti index.php sivulle
                } catch(PDOException $e) {
                    echo 'Käyttäjän tietojen hakuerhe';
                    file_put_contents('log/DBErrors.txt', 'tallennaKayttaja 3: 
'.$e->getMessage()."\n", FILE_APPEND);
                }
            }
        } catch(PDOException $e) {
            echo 'Tietojen lisäyserhe';
            file_put_contents('log/DBErrors.txt', 'tallennaKayttaja 2: '.$e->getMessage()."\n",
                FILE_APPEND);
        }
    } else { 	echo 'Käyttäjä on jo olemassa.';
    }
} catch(PDOException $e) {	echo 'Tietokantaerhe.';
    file_put_contents('log/DBErrors.txt', 'tallennaKayttaja 1: '.$e->getMessage()."\n", FILE_APPEND);
}

?>
