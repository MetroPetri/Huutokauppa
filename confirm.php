<?php require_once("config/config.php") ?>

<?php
//Lomakkeen syöttötiedot $data[] taulukossa
$data = $_POST['data'];
//Laitetaan syötetyt tiedot sessioon jemmaan, jotta voidaan palata muuttamaan annettuja arvoja
$_SESSION['lomakedata'] = serialize($data);

//Ovatko nimi ja email oikein? Nyt tarkistus palvelimella
print_r($_SESSION['lomakedata']);
if(filter_var($data['sähköposti'], FILTER_VALIDATE_EMAIL)) {  //valmis php funktio
    if(preg_match("/^[a-öA-Ö ]*$/",$data['sukunimi'])) { //Sallitaan kirjaimia ja välilyöntejä
        $_SESSION['Kirjautuminen']="onnistui";
        redirect("saveUser.php");
        //* on “useita”   ^  on “täytyy alkaa”
        /*echo '<div class="tiedot">';
        echo 'Nimi: '.$data['etunimi'].' '.$data['sukunimi'];
        echo '<br>';
        echo 'Sähköposti: '.$data['sähköposti'];
        echo '<br>';
        echo 'Sijainti: '.$data['sijainti'];
        echo '</div>';
        echo '<a href="saveUser.php" class="button sininen">Tallenna</a>';
        echo '<br>';
    }else {
        echo("<h3>VAIN KIRJAIMIA JA VÄLILYÖNTEJÄ HYVÄKSYTÄÄN SUKUNIMESSÄ: <br />"
            .$data['sukunimi'] ."</h3>");
     */}

}else{
    /*echo("<h3>LAITON SÄHKÖPOSTIOSOITE: <br />"
        .$data['sähköposti']."</h3>");*/
    $_SESSION['Kirjautuminen']="epäonnistui";
    redirect("index.php");

}/*
echo '<a href="register.php" class="button punainen">Takaisin</a>';*/
?>
