<?php
require_once('config/config.php');
require_once('views/header.php');
?>

<section id="showcase">
    <div class="container">
        <h1>Tuotesivu</h1>
    </div>
</section>

<div class="tuotecontainer">
    <?php
    require_once('views/asideleft.php');
    ?>

    <?php
    $product_id = $_GET['id'];
    $_SESSION['sessionpid']=$product_id;

    $sql = "SELECT *
FROM Tuote WHERE TuoteID = " . $product_id . "";

    $pienikysely = $DBH->prepare($sql);

    $pienikysely->execute();

    while ($rivi = $pienikysely->fetch()) {
        $rivit[]=$rivi;
        $s = $rivi["Kuva"];}
        $tuoteid = $rivi["TuoteID"];

    try{
        while ($rivi = $pienikysely->fetch()) {
            echo"<br /> " .htmlspecialchars($rivi["Nimi"]) . "  " .$rivi["Hinta"] .
                " </br> -";
        }

    } catch (PDOException $e) {
        die("VIRHE: " . $e->getMessage());
    }
    ?>


    <section id="tuotebox">
        <div class="container">
            <?php
            for ($i=0;$i<count($rivit);$i++){
                echo'<div class="box"><img src="'.$rivit[$i]["Kuva"].'"><h3>Tuotteen Nimi:  "'.$rivit[$i]["Nimi"].'"</h3>
            <p>Tuotteen kuvaus:  "'.$rivit[$i]["Kuvaus"].'"</p><p>Tuotteen karma:  "'.$rivit[$i]["upvote"].'"</p></div>';
                echo'<div class="box"><h3>Hinta jolla tuotteen voi ostaa heti</h3><p>"'.$rivit[$i]["Ostaheti"].'"</p>
            <h3>Korkein tarjous</h3><p>"'.$rivit[$i]["Hinta"].'"</p><h3>Viimeinen tarjousajankohta</h3><p>"'.$rivit[$i]["EndDate"].'"</p><h3>Aseta tarjous</h3><form method="post" enctype="multipart/form-data" action="ostotapahtumat.php">
                    <input type="number" placeholder="€" name="tarjous" required>

                    <input type="submit" name="laheta" value="Lähetä"/>
                    
                </form><form method="post" enctype="multipart/form-data" action="ostotapahtumat.php">
                    <input type="submit" name="ostaheti" value="Ostaheti"/>
                </form>

            <form method="post" action="like.php">
                <button class="button" type="submit" value="upvote" name="up">upvote</button>
                <button class="button" type="submit" value="downvote" name="down">downvote</button>
            </form>
</div>';
            require_once('ilmoitusnakyma.php');
            }

            ?>

            <?php
            require_once('kommentointi.php');
            ?>


        </div>
    </section>

    </section>
    <?php
    require_once('views/asideright.php');
    ?>

</div>
<?php
require_once('views/end.php');
?>
