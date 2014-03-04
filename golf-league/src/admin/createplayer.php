<?php
include("./requires.inc.php");
include("./config/loadConfiguration.php");

$playerId = "";
if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"]) && isset($_POST["phoneNumber"]) && isset($_POST["fullTime"])) {
    $playerId = PlayerDAO::addPlayerByAdmin($_POST["firstName"], $_POST["lastName"], $_POST["email"], $_POST["phoneNumber"], $_POST["fullTime"]);
}

if ($playerId == "") {
    echo "Write failed - contact your system administrator";
} else {
    header("location: admin-players.php");
}
?>