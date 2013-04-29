<?php
include("./requires.inc.php");
include("./config/loadConfiguration.php");
include('./validate-admin.php');

$teamId = "";
if ($_GET["id"]) {
    $teamId = TeamDAO::deleteTeam($_GET["id"]);
}

if ($teamId == "") {
    echo "Delete failed - contact your system administrator";
} else {
    header("location: admin-teams.php");
}
?>