<?php
require_once('./config.inc.php');
require_once("./dao/PlayerDAO.php");
require_once("./dao/DBUtils.php");
require_once("./model/Player.php");
require_once("./utils/ArrayUtils.php");

// loop through the posted variables
foreach($_POST as $k=>$handicap) {
    if (strpos($k, "player-") !== false) {
        $playerId = substr($k, 7);
        
        if ($handicap != "") {
            PlayerDAO::assignPlayerHandicap($playerId, $handicap);
        }
    }
}

header("location: admin-assignHandicap.php");
?>