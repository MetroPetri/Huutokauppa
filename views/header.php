<?php
require_once('config/config.php');
require_once ('views/header.php');
$userEtunimi = $_SESSION["etunimi"];
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
<section>
    <nav id="navigation">
        <ul>
            <li><a href="index.php">Koti</a></li>
            <li><a href="all.php">Kaikki tuotteet</a></li>
            <?php
            if (isset($userEtunimi)) {
                echo '<li><a id="uploadNappi" href="upload.php">Jätä ilmoitus</a></li>';
            }
            ?>

            <li><a href="info.php">Tietoa meistä</a></li>
            <li><a href="tarkempihaku.php">Tarkempi haku</a></li>
        </ul>
        <div id="welcomemessage">

            <?php

            $Tervetuloa = 'Tervetuloa';

            $userEtunimi = $_SESSION["etunimi"];
            $userSukunimi = $_SESSION["sukunimi"];
            ?>
            <div class="gridContainer clearfix">
                <div id="div1" class="fluid">

                </div>
                <div id="LoggedInUser" class="fluid "> <?php
                    if (isset($userEtunimi)) {
                        echo $Tervetuloa;
                        echo "\x20";
                        echo $userEtunimi;
                        echo "\x20";
                        echo $userSukunimi;
                    }
                    ?> </div>
            </div>
        </div>
    </nav>

    <div id="upload" class="hidden">
        <span class="close" title="Close Modal">&times;</span>
        <form class="modal-content animate" action="upload_data.php" method="post" enctype="multipart/form-data">
            <div class="imgcontainer">
                <img src="img/hammer.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
            <label><b>Nimeä ilmoituksesi</b></label>
            <input type="text" placeholder="Tuote" name="tuote" required>

            <label><b>Takaraja</b></label>
            <input type="text" placeholder="YYYY-MM-DD HH:MI:SS" name="takaraja" required pattern="\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}:\d{2}">
            </br>

            <label><b>Kuvaus</b></label>
            <input type="text" placeholder="Tuotteen kuvaus..." name="kuvaus" required>

            <label><b>Kategoria</b></label>

                <?php

                $query1 = $DBH->query("SELECT * FROM Tuotekategoria");

                echo '<select name="kategoria">';

                while ($row1 = $query1->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row1['KategoriaID'] . '">' . $row1['Kategoria'] . '</option>';
                }

                echo '</select>';
                ?>
                </br>
                <label><b>Kunto</b></label>
                <div type="">
                    <?php

                    $query = $DBH->query("SELECT * FROM Kunto"); // Run your query

                    echo '<select name="kunto">'; // Open your drop down box

                    // Loop through the query results, outputing the options one by one
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row['ID'] . '">' . $row['Arvo'] . '</option>';
                    }

                    echo '</select>';// Close your drop down box
                    ?>
                </div>
                </br>
                <div type="">
                <label><b>Lähtöhinta</b></label>
                <input type="number" placeholder="€" name="lahtohinta" required>
                <!--<label><b>Sijainti</b></label>
                <input type="text" placeholder="Sijainti" name="sijainti" required>-->
                    </br>
                <label><b>Buyout</b></label>
                <input type="number" placeholder="€" name="ostaheti" required>
                </div>

            </div>

                <div class="container" style="background-color:#f1f1f1">

                    <input type="file" name="file" id="fileUp">
                    <input type="submit" value="Aseta myynti-ilmoitus">
                </div>
            </div>
        </form>
    </div>


</section>