<?php
if($_SESSION['kirjautunut'] == 'yes’'){
    //Ladataan tämä (käyttäjän tiedot

}else{
    //Näytetään lomake
    include('login.php');
}
?>
Jos on kirjautunut käyttäjä, voi hänen tiedot näyttää esim. seuraavasti:
<p>Käyttäjätiedot</p>
<?php
echo '<div class="tiedot">';
echo 'Nimi: '.$_SESSION['etunimi'].' '.$_SESSION['sukunimi'];
echo '<br>';
echo 'Sähköposti: '.$_SESSION['sähköposti'];
echo '<br>';
echo 'Sijainti: '.$_SESSION['sijainti'];
echo('<a href=logout.php" class="button punainen">Kirjaudu ulos</a>');
echo '</div>';
?>
