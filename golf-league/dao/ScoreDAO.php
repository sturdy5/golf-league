<?php
/*
 * Please add the following as required elements when including this file
 * 		- config.inc.php
 * 		- DBUtils.php
 */

/**
 * This class is used to save and retrieve scores.
 * 
 * @author Jon Sturdevant
 */
 class ScoreDAO {
 	
 	const SAVE_SCORE = "insert into scores (hole_id, player_id, match_id, score) values (%s, %s, %s, '%s')";
 	const UPDATE_SCORE = "update scores set score = '%s' where hole_id = %s and player_id = %s and match_id = %s";
 	const GET_SCORE = "select * from scores where hole_id = %s and player_id = %s and match_id = %s";
 	const GET_SCORES_BY_MATCH_AND_PLAYER = "select * from scores where match_id = %s and player_id = %s order by hole_id asc";
 	const GET_PLAYERS_BY_MATCH = "select distinct player_id from scores where match_id = %s";
 	
 	public static function saveScore($holeId, $playerId, $matchId, $score) {
 		$query = vsprintf(self::SAVE_SCORE, array($holeId, $playerId, $matchId, $score));
 		if (self::scoreExists($holeId, $playerId, $matchId)) {
 			$query = vsprintf(self::UPDATE_SCORE, array($score, $holeId, $playerId, $matchId));
 		}
 		$result = @mysql_query($query);
 		if (!$result) {
 			throw new Exception("DB : " . mysql_error());
 		}
 	}
 	
 	private static function scoreExists($holeId, $playerId, $matchId) {
 		$result = false;
 		$query = vsprintf(self::GET_SCORE, array($holeId, $playerId, $matchId));
 		$results = @mysql_query($query);
 		if ($results) {
 			$count = mysql_num_rows($results);
 			if ($count > 0) {
 				$result = true;
 			}
 		} else {
 			throw new Exception("DB : " . mysql_error());
 		}
 		return $result;
 	}
 	
 	public static function getScoresByMatchIdAndPlayer($matchId, $playerId) {
 		$query = vsprintf(self::GET_SCORES_BY_MATCH_AND_PLAYER, array($matchId, $playerId));
 		$result = @mysql_query($query);
 		$scores = null;
 		if ($result) {
 			$scores = new Scores();
 			$scores->match = $matchId;
 			$scores->player = $playerId;
 			while ($row = mysql_fetch_array($result)) {
 				$scores->scores[$row["hole_id"]] = $row["score"];
 			}
 		} else {
 			throw new Exception("DB : " . mysql_error());
 		}
 		
 		return $scores;
 	}
 	
 }
 ?>