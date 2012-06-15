<?php
require_once('./config.inc.php');
require_once("./dao/PlayerDAO.php");
require_once("./dao/DBUtils.php");
require_once("./model/Player.php");
require_once("./utils/ArrayUtils.php");

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