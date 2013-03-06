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
require_once("./../model/Scores.php");
require_once("./../utils/ArrayUtils.php");

    $playerId = $_GET["player"];
	$player = PlayerDAO::getPlayer($playerId);
	
	echo "Player: " . $player->firstName . " " . $player->lastName . " (" . $player->handicap . ")";
    
    $scores = PlayerDAO::getLastNScores($playerId, 8);
    $scoreFromPar = array();
    
    foreach ($scores as $score) {
    	echo "<br/>";
    	echo "Date: $score->matchDate ";
    	echo "Score: $score->totalScore ";
    	echo "From par: " . ($score->totalScore - 36);
        array_push($scoreFromPar, $score->totalScore - 36);
    }
    
    $totalElements = count($scores);
    $combinedPar = array_sum($scoreFromPar);
    
    $handicap = (int) ($combinedPar / $totalElements);
    
    echo "<br/>Handicap: $handicap";
?>