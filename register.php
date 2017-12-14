<?php
require_once('config/config.php');
?>
<form action="confirm.php" method="post">
    <?php
    //Halutaanko vaihtaa käyttäjätietoja - loggautunut käyttäjä
    //Käyttäjätiedot syöttövaiheessa assosiatiiviseen taulukkoon data[]  eli elementin indeksi on nimi
    //print_r($_SESSION);
    if (isset($_SESSION['lomakedata'])) {  //Ollaanko muuttamassa käyttäjätietoja eli on  kirjautunut käyttäjä
        $lomakedata = unserialize($_SESSION['lomakedata']);
        ?>
        <input type="text" name="data[etunimi]" value="<?php echo $lomakedata['etunimi']; ?>" required><span>*</span>
        <br>
        <input type="text" name="data[sukunimi]" value="<?php echo $lomakedata['sukunimi']; ?>" required><span>*</span>
        <br>
        <input type="text" name="data[sijainti]" value="<?php echo $lomakedata['sijainti']; ?>" required><span>*</span>
        <br>

        <?php
    } else { //Luodaan uudet käyttäjätunnukset
        ?>
        <input type="text" name="data[etunimi]" placeholder="Etunimi" required><span>*</span>
        <br>
        <input type="text" name="data[sukunimi]" placeholder="Sukunimi" required><span>*</span>
        <br>
        <input type="email" name="data[sähköposti]" placeholder="Sähköposti" required><span>*</span>
        <br>
        <input type="text" name="data[sijainti]" placeholder="Maakunta" required><span>*</span>

        <?php
    }
    ?>
    <br>
    <input type="password" name="data[pwd]" placeholder="Salasana" required><span>*</span>
    <br>
    <input type="submit" value="Tallenna">
</form>
<script>
  var salasana = document.querySelector('input[name="givenPw"]');
  var varmistus = document.querySelector('input[name="givenPwAgain"]');
  var fillPattern = function() {
    varmistus.pattern = this.value;
  };
  salasana.addEventListener('keyup', fillPattern);


</script>
<!--

//-->
</script>
