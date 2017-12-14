<?php
require_once('config/config.php');

SSLon();
//Tänne tullaan kun ilogSign.php lomakkeella painetaan Kirjaudu painiketta
//Kayttaja/salasana kannassa?
//user oliossa kayttajatiedot jos ok, muuten false

$user = login($_POST['sahkoposti'], $_POST['pwd'], $DBH);
//print_r($user);
if(!$user){
    $_SESSION['VIRHE'] = 'jep';
    //Aiheuttaa alert() pääsivulla
    $error_msg = "<div class='modal'id='wrongpass' >Username or password is incorrect</div>";
    $script = "<script> $(document).ready(function(){ $(\"#wrongpass\").modal(\"show\");    });</script>";
    redirect(SITE_ROOT);
} else {
    unset($_SESSION['VIRHE']);
    //Jos käyttäjätunnistettiin, talletetaan tiedot sessioon esim. kassalle siirtymistä
    //varten on hyvä tietää asiakastiedot
    $_SESSION['kirjautunut'] = 'yes';
    $_SESSION['etunimi'] = $user->Nimi;
    $_SESSION['sukunimi'] = $user->Sukunimi;
    $_SESSION['sijainti'] = $user->Sijainti;
    $_SESSION['sahkoposti'] = $user->Email;
    $_SESSION['ID'] = $user->ID;

    //Jos loggaus onnistuu niin palataan paasivulle
    $aika = date('Y-m-d H:i:s');
    $STH = $DBH->prepare("SELECT * FROM User WHERE User.Email = '{$_SESSION['sahkoposti']}' ");
    $STH->execute();
    $kayttaja = $STH->fetch(PDO::FETCH_ASSOC);

    $STH2 = $DBH->prepare('INSERT INTO Log (kayttaja, sisaan)

			VALUES (:kayttaja, :aika);');
    $STH2->bindParam(':kayttaja', $kayttaja['ID']);
    $STH2->bindParam(':aika', $aika);
    $STH2->execute();
    redirect(SITE_ROOT);


    print_r($_SESSION);
}
?>