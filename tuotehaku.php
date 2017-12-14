<?php
require_once("config/config.php");


//Samanalkuinen tuotenimi, minimi- ja maksimihinta
?>




<?php
require_once('config/config.php');
?>
<!doctype html>


<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        Huutokauppa | Tervetuloa
    </title>

    <meta name="description" content="Suomen paras nettihuutokauppa">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<header>
    <div class="container">
        <div id="mainlogo">
            <img src="img/Huutokauppa.png">

        </div>
    </div>
</header>

<section id="navigation">
    <nav>
        <ul>
            <li><a href="index.php">Koti</a></li>
            <li><a href="index.php">Kaikki tuotteet</a></li>
            <li><a href="index.php">Jätä ilmoitus</a></li>
            <li><a href="index.php">Tietoa meistä</a></li>
            <li><a href="index.php">Rekisteröidy tästä!</a></li>
        </ul>
    </nav>
</section>
<section id="showcase">
    <div class="container">
        <h1>Etusivun nostotuote</h1>
    </div>
</section>


<aside id="left">
    <div class="kategoriat" id="kategoriat">
        <h2>Kategoriat
        </h2>

        <a href="#">Huonekalu</a>
        <a href="#">Auto</a>
        <a href="#">Elektroniikka</a>
        <a href="#">Audio</a>
    </div>

    <div class="paikkakunnat" id="paikkakunnat">
        <h2>Paikkakunnat</h2>

        <a href="#">UuSimaa</a>
        <a href="#">Lappi</a>
        <a href="#">HeseXD</a>
        <a href="#">Turku</a>
    </div>

</aside>

<aside id="right">
    <!-- Button to open the modal login form -->
    <button onclick="document.getElementById('login').style.display='block'">Kirjaudu sisään</button>

    <!-- The Modal -->
    <div id="login" class="modal">
  <span onclick="document.getElementById('login').style.display='none'"
        class="close" title="Close Modal">&times;</span>

        <!-- Modal Content -->
        <form class="modal-content animate" action="login.php" method="post">
            <div class="imgcontainer">
                <img src="img/hammer.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label><b>Sähköpostiosoite</b></label>
                <input type="text" placeholder="Sähköpostiosoite" name="data[sähköposti]" required>

                <label><b>Salasana</b></label>
                <input type="password" placeholder="Salasana" name="data[pwd]" required>

                <button type="submit">Kirjaudu sisään!</button>
                <input type="checkbox" checked="checked"> Muista minut
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('login').style.display='none'" class="cancelbtn">Poistu</button>
                <span class="pwd">Unohditko <a href="">salasanasi?</a></span>
            </div>
        </form>
    </div>

    <!-- Button to open the modal login form -->
    <button onclick="document.getElementById('register').style.display='block'">Rekisteröidy tästä!</button>

    <!-- The Modal -->
    <div id="register" class="modal">
  <span onclick="document.getElementById('register').style.display='none'"
        class="close" title="Close Modal">&times;</span>

        <!-- Modal Content -->
        <form class="modal-content animate" action="confirm.php" method="post">
            <div class="imgcontainer">
                <img src="img/hammer.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label><b>Etunimi</b></label>
                <input type="text" placeholder="Etunimi" name="data[etunimi]" required>

                <label><b>Sukunimi</b></label>
                <input type="text" placeholder="Sukunimi" name="data[sukunimi]" required>

                <!--<label><b>Sijainti</b></label>
                <input type="text" placeholder="Sijainti" name="data[sijainti]" required>-->

                <label><b>Maakunta</b></label>
                <div type="kunta">
                    <?php


                    $query = $DBH->query("SELECT * FROM Sijainti"); // Run your query

                    echo '<select name="data[sijainti]">'; // Open your drop down box

                    // Loop through the query results, outputing the options one by one
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="'.$row['SijaintiID'].'">'.$row['Maakunta'].'</option>';
                    }

                    echo '</select>';// Close your drop down box
                    ?>
                </div>



                <label><b>Sähköposti</b></label>
                <input type="email" placeholder="Sähköposti" name="data[sähköposti]" required>

                <label><b>Salasana</b></label>
                <input type="password" placeholder="Salasana" name="data[pwd]" required>

                <button type="submit">Rekisteröidy</button>

            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('register').style.display='none'" class="cancelbtn">Poistu</button>
            </div>
        </form>
    </div>

</aside>




<section id="boxes">
    <div class="container">
        <form method="POST">
        <label><b>Hakusana</b></label>
        <input type="text" placeholder="Hae..." name="avainsana" required>

            <label><b>Hintahaarukka</b></label>
            <input type="number" placeholder="Min. hinta €" name="minhinta" required>
            <input type="number" placeholder="Max. hinta €" name="maxhinta"/><br>
            <input type="reset" value="Resetoi"/>
            <input type="submit" value="Etsi"/>
        </form>
        <?php

        $haku = $_POST["avainsana"];
        $minhinta = $_POST["minhinta"];
        $maxhinta = $_POST["maxhinta"];


        echo("<p> $haku -alkuiset tuotteet hintahaarukalla $minhinta - $maxhinta euroa. </p>");
        $sql = "SELECT *
        FROM Tuote
        WHERE Tuote.Nimi LIKE " . "'" . $haku . "%' AND Tuote.Hinta
        BETWEEN " . $minhinta . " AND " . $maxhinta . "";


        echo($sql); //Testi, miltä lause näyttää - lainausmerkit kohdallaan?
        echo("</br>");
        $kysely = $DBH->prepare($sql);

        $kysely->execute();
        //kuvia varten kansio                               !
        try{
        while ($rivi = $kysely->fetch()) {
            $s=$rivi["Kuva"];

            echo"<a href='http://www.iltalehti.fi/'  /> <img src='kuvat/$s' alt='TOIMINYT' width='42\' height='42'> " .htmlspecialchars($rivi["Nimi"]) . "  " .$rivi["Hinta"] . "€".
        " <a></br> ";
        }

        } catch (PDOException $e) {
        die("VIRHE: " . $e->getMessage());
        }

?>
    </div>

</section>
<footer>
    <p>
        Huutokauppa, Copyright &copy; 2017
    </p>
</footer>






<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- Add your site or application content here -->


<script>
  // Get the modal
  var modal = document.getElementById('login');

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>
<script>
  // Get the modal
  var modal = document.getElementById('register');

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>
<script src="js/vendor/modernizr-3.5.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.2.1.min.js"><\/script>')</script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
  window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
  ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>
</html>
