<?php
require_once('./config.inc.php');
require_once("./dao/PlayerDAO.php");
require_once("./dao/ScheduleDAO.php");
require_once("./dao/TeamDAO.php");
require_once("./dao/DBUtils.php");
require_once("./model/Team.php");
require_once("./model/Player.php");
require_once("./utils/ArrayUtils.php");
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