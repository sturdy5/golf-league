<?php
include("requires.inc.php");

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