<?php
include("requires.inc.php");

// if isset fields, save each field
if (isset($_POST["matchId"])) {
	$matchId = $_POST["matchId"];
	
	$match = ScheduleDAO::getMatchById($matchId);
	$course = CourseDAO::getCourseById($match->course);
	$holes = CourseDAO::getHolesPerSide($match->course, $match->side);
	$hometeam = TeamDAO::getTeamById($match->teams[0]);
	$awayteam = TeamDAO::getTeamById($match->teams[1]);
	
	// need to check for a sub for each player
	$playerId = $hometeam->players[0]->id;
	$subId = ScheduleDAO::getMatchSubstitute($matchId, $playerId);
	if (null != $subId) {
		$player = PlayerDAO::getPlayer($subId);
		$hometeam->players[0] = $player;
	}
	
	$playerId = $hometeam->players[1]->id;
	$subId = ScheduleDAO::getMatchSubstitute($matchId, $playerId);
	if (null != $subId) {
		$player = PlayerDAO::getPlayer($subId);
		$hometeam->players[1] = $player;
	}
	
	$playerId = $awayteam->players[0]->id;
	$subId = ScheduleDAO::getMatchSubstitute($matchId, $playerId);
	if (null != $subId) {
		$player = PlayerDAO::getPlayer($subId);
		$awayteam->players[0] = $player;
	}
	
	$playerId = $awayteam->players[1]->id;
	$subId = ScheduleDAO::getMatchSubstitute($matchId, $playerId);
	if (null != $subId) {
		$player = PlayerDAO::getPlayer($subId);
		$awayteam->players[1] = $player;
	}
	
	// need to check handicaps to ensure the players are in the correct order
	$homeHandicap1 = $hometeam->players[0]->handicap;
	$homeHandicap2 = $hometeam->players[1]->handicap;
	$awayHandicap1 = $awayteam->players[0]->handicap;
	$awayHandicap2 = $awayteam->players[1]->handicap;
	
	$homeIndex1 = 0;
	$homeIndex2 = 1;
	if ($homeHandicap1 > $homeHandicap2) {
		$homeIndex1 = 1;
		$homeIndex2 = 0;
	}
	
	$awayIndex1 = 0;
	$awayIndex2 = 1;
	if ($awayHandicap1 > $awayHandicap2) {
		$awayIndex1 = 1;
		$awayIndex2 = 0;
	}
	
	// pattern - player-o_hole-p
	$playerIds = array($hometeam->players[$homeIndex1]->id, $hometeam->players[$homeIndex2]->id, $awayteam->players[$awayIndex1]->id, $awayteam->players[$awayIndex2]->id);
	foreach ($playerIds as $playerId) {
		foreach ($holes as $hole) {
			$pattern = "player-" . $playerId . "_hole-" . $hole->number;
			if (isset($_POST[$pattern])) {
				$score = $_POST[$pattern];
				ScoreDAO::saveScore($hole->number, $playerId, $matchId, $score);
			}
		}
	}
	$matchDate = $match->date;
	header("location: ../schedule.php?matchDate=$matchDate");
} else {
	header("location: /index.php");
}
?>