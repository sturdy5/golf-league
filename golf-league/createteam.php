<?php
include("./requires.inc.php");
include("./config/loadConfiguration.php");

$teamId = "";
if ($_POST["teamName"] && $_POST["playerIds"]) {
    $teamId = TeamDAO::addTeamByIds($_POST["teamName"], $_POST["playerIds"]);
}

if ($teamId == "") {
    echo "Write failed - contact your system administrator";
} else {
    header("location: admin-teams.php");
}
?>