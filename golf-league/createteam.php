<?php
require_once('./config.inc.php');
require_once("./dao/PlayerDAO.php");
require_once("./dao/TeamDAO.php");
require_once("./dao/DBUtils.php");
require_once("./model/Team.php");
require_once("./model/Player.php");
require_once("./utils/ArrayUtils.php");

$teamId = "";
if ($_POST["teamName"] && $_POST["playerIds"]) {
    $teamId = TeamDAO::addTeamByIds($_POST["teamName"], $_POST["playerIds"]);
}

if ($teamId == "") {
    echo "Write failed - contact your system administrator";
} else {
    $playerArray = explode(",", $_POST["playerIds"]);
    foreach ($playerArray as $playerId) {
        PlayerDAO::addPlayerToTeam($playerId, $teamId);
    }
    header("location: admin-teams.php");
}
?>