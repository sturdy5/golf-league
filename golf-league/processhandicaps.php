<?php
include("./requires.inc.php");

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