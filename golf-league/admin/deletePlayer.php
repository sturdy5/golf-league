<?php
require_once("./../config.inc.php");
require_once("./../dao/DBUtils.php");
require_once("./../dao/ScheduleDAO.php");
require_once("./../dao/PlayerDAO.php");
require_once("./../dao/TeamDAO.php");
require_once("./../model/Schedule.php");
require_once("./../model/ScheduleDate.php");
require_once("./../model/Matchup.php");
require_once("./../model/Team.php");
require_once("./../model/Player.php");
require_once("./../utils/ArrayUtils.php");
include('./../validate-admin.php');
    if (isset($_GET["id"])) {
        PlayerDAO::removePlayer($_GET["id"]);
    }
    header("location: ../admin-players.php");
?>