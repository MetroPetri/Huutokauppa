<form method="post" action="like.php">
<button type="submit" value="upvote" name="up">upvote</button>
<button type="submit" value="downvote" name="down">downvote</button>
</form>
<?php
require_once('config/config.php');


$ID = $_SESSION['ID'];
$up = $_POST ["up"];
$down = $_POST ["down"];
$tuote = $_SESSION['sessionpid'];

if(isset($_POST['up'])) {
    require_once('config/config.php');
    $STH = $DBH->prepare('UPDATE Tuote SET upvote = upvote + 1

			WHERE TuoteID = :tuote;');
    $STH->bindParam(":tuote", $tuote);
    $STH->execute();
    redirect("product.php?id=$tuote");
}
if (isset($_POST['down'])) {
    require_once('config/config.php');
    $STH2 = $DBH->prepare('UPDATE Tuote SET upvote = upvote - 1

			WHERE TuoteID = :tuote;');
    $STH2->bindParam(":tuote", $tuote);
    $STH2->execute();
    redirect("product.php?id=$tuote");
}

?>