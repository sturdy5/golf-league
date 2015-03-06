<?php
/*
 * Please add the following as required elements when including this file
*     - config.inc.php
*     - dao/DBUtils.php
*     - model/Schedule.php
*     - model/Matchup.php
*     - model/ScheduleDate.php
*/

/**
 * This class is used to retrieve all of the information relating to
 * schedules.
 *
 * @author Jon Sturdevant
 */
class ScheduleDAO {

    /* sql related to season management */
    const GET_SEASON_SQL = "select id, startDate, endDate, team_structure, score_style from seasons where startDate < ADDDATE(CURDATE(), INTERVAL 21 DAY) and endDate > CURDATE() order by id asc";
    const CREATE_SEASON_SQL = "insert into seasons (startDate, endDate, courseId, team_structure, score_style) values ('%s', '%s', '%s', '%s', '%s')";
    const GET_LAST_SEASON_SQL = "select id, startDate, endDate, team_structure, score_style from seasons where endDate < CURDATE() order by endDate desc limit 0, 1";
    const GET_SEASON_BY_DATE_SQL = "select * from seasons where startDate <= '%s' and endDate >= '%s'";
    const GET_COURSE_BY_SEASON_SQL = "select courseId from seasons where id = %s";

    /* sql related to player schedules */
    const GET_UNIQUE_DATES_SQL = "select distinct s.date, n.notes from schedule s left join schedule_notes n on s.date = n.date where s.date > '%s' and s.date < '%s' order by s.date asc";
    const UPDATE_SCHEDULE_DATE = "update schedule set date = '%s' where date = '%s'";
    const GET_SCHEDULE_BY_DATE_SQL = "select * from schedule where date = '%s'";
    const ASSIGN_HOLE_SQL = "update schedule set startingHole = %s where id = %s";
    const ADD_SCHEDULE_SQL = "insert into schedule (date, home, away, side, course, startingHole) values ('%s', '%s', '%s', '%s', %s, %s)";
    const DELETE_PLACEHOLDER_SQL = "delete from schedule where date = '%s' and home = '0' and away = '0'";
    const GET_MATCH_SQL = "select * from schedule where id = %s";

    /* sql related to schedule notes */
    const UPDATE_SCHEDULE_NOTES = "update schedule_notes set notes = '%s' where date = '%s'";
    const ADD_SCHEDULE_NOTES = "insert into schedule_notes (notes, date) values ('%s', '%s')";
    const GET_SCHEDULE_NOTES = "select * from schedule_notes where date = '%s'";
    const UPDATE_SCHEDULE_NOTES_DATE = "update schedule_notes set date = '%s' where date = '%s'";
    const DELETE_SCHEDULE_NOTES = "delete from schedule_notes where date = '%s'";

    /* sql related to schedule subs */
    const GET_FUTURE_AVAILABLE_DATE_SUBS_SQL = "select * from date_subs where date >= curdate() and sub_id = 'X' order by date asc";
    const GET_FUTUTE_TAKEN_DATE_SUBS_SQL = "select * from date_subs where date >= curdate() and sub_id <> 'X' order by date asc";
    const GET_TAKEN_DATE_SUBS_SQL = "select * from date_subs where date = '%s' and sub_id <> 'X'";
    const GET_SUBS_BY_MATCH_SQL = "select * from schedule_subs where match_id = %s and player_id = %s";
    const GET_SUBS_BY_DATE_SQL = "select * from date_subs where date = '%s' and player_id = '%s'";
    const GET_PLAYER_BY_MATCH_AND_SUB_SQL = "select * from schedule_subs where match_id = %s and sub_id = %s";
    const ASSIGN_SUBS_SQL = "insert into schedule_subs (sub_id, match_id, player_id) values (%s, %s, %s)";
    const ADD_SUB_BY_DATE_SQL = "insert into date_subs (date, player_id, sub_id) values ('%s', '%s', '%s')";
    const REMOVE_SUB_SQL = "delete from schedule_subs where match_id = %s and sub_id = %s";
    const REMOVE_SUB_BY_DATE_SQL = "delete from date_subs where player_id = '%s' and date = '%s'";
    const UPDATE_SUBS_SQL = "update schedule_subs set sub_id = %s where match_id = %s and player_id = %s";
    const UPDATE_SUB_BY_DATE_SQL = "update date_subs set sub_id = '%s' where date = '%s' and player_id = '%s'";

    /* sql related to course schedules */
    const GET_CURRENT_COURSE_SCHEDULE = "select distinct s.id, s.match_date, c.name, s.side, n.notes, s.details_exist from schedule_course s left join schedule_notes n on s.match_date = n.date left join courses c on s.course = c.id where s.match_date >= '%s' and s.match_date <= '%s' order by s.match_date asc";
    const GET_SINGLE_COURSE_SCHEDULE = "select s.id, s.match_date, c.name, s.side, n.notes, s.details_exist from schedule_course s left join schedule_notes n on s.match_date = n.date left join courses c on s.course = c.id where s.id = %s";
    const GET_SINGLE_COURSE_SCHEDULE_BY_DATE = "select s.id, s.match_date, c.id as courseId, c.name, s.side, n.notes, s.details_exist from schedule_course s left join schedule_notes n on s.match_date = n.date left join courses c on s.course = c.id where s.match_date = '%s'";
    const GET_NEXT_SINGLE_COURSE_SCHEDULE = "select s.id, s.match_date, c.name, s.side, n.notes, s.details_exist from schedule_course s left join schedule_notes n on s.match_date = n.date left join courses c on s.course = c.id where s.match_date >= curdate() order by s.match_date asc";
    const UPDATE_SINGLE_COURSE_SCHEDULE = "update schedule_course set match_date = '%s', course = %s, side = '%s', details_exist = %s where id = %s";
    const ADD_SINGLE_COURSE_SCHEDULE = "insert into schedule_course (match_date, course, side) values ('%s', %s, '%s')";
    const REMOVE_SINGLE_COURSE_SCHEDULE = "delete from schedule_course where id = %s";
    const SET_COURSE_SCHEDULE_DETAILS = "update schedule_course set details_exist = %s where id = %s";

    /**
     * Create a new season definition. This will also add the course dates.
     *
     * @param unknown $startDate
     * @param unknown $endDate
     * @param unknown $courseId
     * @param unknown $teamStructure
     * @param unknown $scoreStyle
     * @throws Exception
     * @return The id of the season that was created
     */
    public static function createSeason($startDate, $endDate, $courseId, $teamStructure, $scoreStyle) {
    	$data = DBUtils::escapeData(array($startDate, $endDate, $courseId, $teamStructure, $scoreStyle));
    	$query = vsprintf(self::CREATE_SEASON_SQL, $data);
    	$result = @mysql_query($query);

    	$seasonId = "";
    	if ($result) {
    		$seasonId = mysql_insert_id();
    	} else {
    		throw new Exception("DB : " . mysql_error());
    	}

    	// now that the season exists, let's add the dates to the schedule.

    	// now let's assume for now that all scheduled dates will be on Thursdays
    	$date = new DateTime($startDate);
    	$stopDate = new DateTime($endDate);
    	$thursdays = array();

    	while ($date <= $stopDate) {
    		/*
    		 * PHP >= 5.3
    		 *    $dayOfWeek = date("w", $date->getTimestamp());
    		 */
    		$dayOfWeek = date("w", $date->format('U'));
    		if ($dayOfWeek == 4) {
    			array_push($thursdays, $date->format("Y-m-d"));
    		}
    		/*
    		 * PHP >= 5.3
    		 *    $date = $date->modify("+1 day");
    		 */
    		$date = new DateTime('@' . ($date->format('U') + 86400));
    	}

    	$sideIndex = 0;
    	foreach($thursdays as $thursday) {
    		// create a match date
    		$side = $sides[$sideIndex];
    		$sideIndex++;
    		if ($sideIndex >= $numberOfSides) {
    			$sideIndex = 0;
    		}
            self::addCourseScheduleMatch($thursday, $courseId, $sides[$sideIndex], 0);
    	}

    	return $seasonId;
    }

    /**
     * TODO Document this function
     *
     * @param unknown $date
     * @param unknown $homeTeamId
     * @param unknown $awayTeamId
     * @param unknown $sideName
     * @param unknown $courseId
     * @param number $hole
     * @throws Exception
     * @return Ambigous <string, number>
     */
    public static function addMatch($date, $homeTeamId, $awayTeamId, $sideName, $courseId, $hole = 0) {
    	$data = DBUtils::escapeData(array($date, $homeTeamId, $awayTeamId, $sideName, $courseId, $hole));
    	$query = vsprintf(self::ADD_SCHEDULE_SQL, $data);
    	$result = @mysql_query($query);

    	$matchId = "";
    	if ($result) {
    		$matchId = mysql_insert_id();
    	} else {
    		throw new Exception("DB : " . mysql_error());
    	}

    	return $matchId;
    }

    /**
     * TODO Document this function
     *
     * @param unknown $date
     * @throws Exception
     * @return number
     */
    public static function getSeasonByDate($date) {
    	$query = vsprintf(self::GET_SEASON_BY_DATE_SQL, array($date, $date));
    	$result = @mysql_query($query);
    	$seasonId = -1;
    	if ($result) {
    		$row = mysql_fetch_assoc($result);
    		$seasonId = $row["id"];
    	} else {
    		throw new Exception("DB : " . mysql_error());
    	}
    	return $seasonId;
    }

    /**
     * TODO Document this function
     *
     * @param unknown $date
     * @throws Exception
     * @return string
     */
    public static function getSeasonTeamStructureByDate($date) {
    	$query = vsprintf(self::GET_SEASON_BY_DATE_SQL, array($date, $date));
    	$result = @mysql_query($query);
    	$teamStructure = "INDIVIDUAL";
    	if ($result) {
    		$row = mysql_fetch_assoc($result);
    		$teamStructure = $row["team_structure"];
    	} else {
    		throw new Exception("DB : " . mysql_error());
    	}
    	return $teamStructure;
    }

    /**
     * TODO Document this function
     *
     * @throws Exception
     * @return number
     */
    public static function getCurrentSeason() {
    	$result = @mysql_query(self::GET_SEASON_SQL);
    	$seasonId = -1;
    	if ($result) {
    		$row = mysql_fetch_assoc($result);
    		$seasonId = $row["id"];
    	} else {
    		throw new Exception ("DB : Could not get the current season");
    	}
    	return $seasonId;
    }

    /**
     * TODO Document this function
     *
     * @param unknown $seasonId
     * @throws Exception
     * @return unknown
     */
    public static function getCourseBySeason($seasonId = -1) {
    	if ($seasonId == -1) {
    		$seasonId = self::getCurrentSeason();
    	}

    	$query = vsprintf(self::GET_COURSE_BY_SEASON_SQL, array($seasonId));
    	$result = @mysql_query($query);
    	$courseId = -1;
    	if ($result) {
    		$row = mysql_fetch_array($result);
    		$courseId = $row["courseId"];
    	} else {
    		throw new Exception("DB : " . mysql_error());
    	}
    	return $courseId;
    }

    /**
     * Get a list of the scheduled dates that are for the current or up-coming season.
     *
     * @return A list of ScheduleDate objects that represent the dates
     */
    public static function getScheduledDates() {
        $dates = array();
        $seasonId = "none";
        $startDate = null;
        $endDate = null;
        $result = mysql_query(self::GET_SEASON_SQL) or die("Could not determine the season that is currently in session");
        if ($result) {
        	$count = mysql_num_rows($result);
            for ($i = 0; $i < $count; $i++) {
                $row = mysql_fetch_assoc($result);
                $seasonId = $row["id"];
                $startDate = $row["startDate"];
                $endDate = $row["endDate"];
        	}
        } else {
            $result = mysql_query(self::GET_LAST_SEASON_SQL) or die("Could not determine the season that was last in session");
            if ($result) {
                $row = mysql_fetch_assoc($result);
                $seasonId = $row["id"];
                $startDate = $row["startDate"];
                $endDate = $row["endDate"];
            }
        }

        if ($seasonId != "none") {
            $dates = self::getCourseScheduleMatches($startDate, $endDate);
        }

        return $dates;
    }

    /**
     * TODO Document this function
     *
     * @param unknown $matchId
     * @param unknown $playerId
     * @return NULL
     */
    public static function getMatchSubstitute($matchId, $playerId) {
        $data = DBUtils::escapeData(array($matchId, $playerId));
        $query = vsprintf(self::GET_SUBS_BY_MATCH_SQL, $data);
        $result = mysql_query($query) or die("Could not get the substitutes for the match $matchId and player $playerId");
        $subId = null;
        if ($result) {
            $row = mysql_fetch_assoc($result);
            $subId = $row["sub_id"];
        }
        return $subId;
    }

    /**
     * TODO Document this function
     *
     * @return multitype:
     */
    public static function getFutureAvailableDateSubs() {
    	$query = self::GET_FUTURE_AVAILABLE_DATE_SUBS_SQL;
    	$result = @mysql_query($query);
    	$subsList = array();
    	if ($result) {
    		$count = mysql_num_rows($result);
    		for ($i = 0; $i < $count; $i++) {
    			$row = mysql_fetch_assoc($result);
    			$subEntry = array(
    					"date" => $row["date"],
    					"player" => $row["player_id"]);
    			array_push($subsList, $subEntry);
    		}
    	}
    	return $subsList;
    }

    /**
     * TODO Document this function
     *
     * @return multitype:
     */
    public static function getFutureTakenDateSubs() {
    	$query = self::GET_FUTUTE_TAKEN_DATE_SUBS_SQL;
    	$result = @mysql_query($query);
    	$subsList = array();
    	if ($result) {
    		$count = mysql_num_rows($result);
    		for ($i = 0; $i < $count; $i++) {
    			$row = mysql_fetch_assoc($result);
    			$subEntry = array(
    					"date" => $row["date"],
    					"player" => $row["player_id"],
    					"sub" => $row["sub_id"]);
    			array_push($subsList, $subEntry);
    		}
    	}
    	return $subsList;
    }

    /**
     * TODO Document this function
     *
     * @param unknown $date
     * @return multitype:
     */
    public static function getTakenDateSubsByDate($date) {
    	$data = DBUtils::escapeData(array($date));
    	$query = vsprintf(self::GET_TAKEN_DATE_SUBS_SQL, $data);
    	$result = @mysql_query($query);
    	$subsList = array();
    	if ($result) {
    		$count = mysql_num_rows($result);
    		for ($i = 0; $i < $count; $i++) {
    			$row = mysql_fetch_assoc($result);
    			array_push($subsList, $row["sub_id"]);
    		}
    	}
    	return $subsList;
    }

    /**
     * TODO Document this function
     *
     * @param unknown $date
     * @param unknown $playerId
     * @throws Exception
     * @return NULL
     */
    public static function getSubstituteByDate($date, $playerId) {
    	$data = DBUtils::escapeData(array($date, $playerId));
    	$query = vsprintf(self::GET_SUBS_BY_DATE_SQL, $data);
    	$result = @mysql_query($query);
    	$subId = null;
    	if ($result) {
    		$row = mysql_fetch_assoc($result);
    		$subId = $row["sub_id"];
    	} else {
    		throw new Exception("DB : " . mysql_error());
    	}
    	return $subId;
    }

    /**
     * TODO Document this function
     *
     * @param unknown $matchId
     * @param unknown $subId
     */
    public static function removeMatchSubstitute($matchId, $subId) {
    	$data = DBUtils::escapeData(array($matchId, $subId));
    	$query = vsprintf(self::REMOVE_SUB_SQL, $data);
    	$result = mysql_query($query) or die("Couldn't remove the sub");
    }

    /**
     * TODO Document this function
     *
     * @param unknown $date
     * @param unknown $playerId
     */
    public static function removeSubByDate($date, $playerId) {
    	$data = DBUtils::escapeData(array($playerId, $date));
    	$query = vsprintf(self::REMOVE_SUB_BY_DATE_SQL, $data);
    	$result = mysql_query($query) or die("Couldn't remove the sub request");
    }

    /**
     * TODO Document this function
     *
     * @param unknown $matchId
     * @param unknown $subId
     * @return NULL
     */
    public static function getPlayerBySubstitute($matchId, $subId) {
    	$data = DBUtils::escapeData(array($matchId, $subId));
    	$query = vsprintf(self::GET_PLAYER_BY_MATCH_AND_SUB_SQL, $data);
    	$result = mysql_query($query) or die("Could not get the player for the match $matchId and sub $subId");
    	$playerId = null;
    	if ($result) {
    		$row = mysql_fetch_assoc($result);
    		$playerId = $row["player_id"];
    	}
    	return $playerId;
    }

    /**
     * TODO Document this function
     *
     * @param unknown $matchId
     * @param unknown $playerId
     * @param unknown $subId
     */
    public static function assignSub($matchId, $playerId, $subId) {
    	// need to figure out if a sub is already assigned
    	$existingSub = ScheduleDAO::getMatchSubstitute($matchId, $playerId);
    	$useUpdate = (null != $existingSub);
    	$data = DBUtils::escapeData(array($subId, $matchId, $playerId));
    	if ($useUpdate) {
    		$query = vsprintf(self::UPDATE_SUBS_SQL, $data);
    	} else {
    		$query = vsprintf(self::ASSIGN_SUBS_SQL, $data);
    	}
    	$result = mysql_query($query) or die("Could not assign the sub for the hole");
    }

    /**
     * TODO Document this function
     *
     * @param unknown $date
     * @param unknown $playerId
     * @param string $subId
     * @return boolean
     */
    public static function assignSubByDate($date, $playerId, $subId = "X") {
    	// need to figure out if a sub is already assigned
    	$existingSub = ScheduleDAO::getSubstituteByDate($date, $playerId);
    	$newSub = (null == $existingSub);
    	$alreadyTaken = ("X" != $existingSub);
    	$success = false;
    	if ($newSub) {
    		$query = vsprintf(self::ADD_SUB_BY_DATE_SQL, DBUtils::escapeData(array($date, $playerId, $subId)));
    		mysql_query($query);
    		$success = true;
    	} else if (!$alreadyTaken) {
    		$query = vsprintf(self::UPDATE_SUB_BY_DATE_SQL, DBUtils::escapeData(array($subId, $date, $playerId)));
    		mysql_query($query);
    		$success = true;
    	}

    	return $success;
    }

    /**
     * TODO Document this function
     *
     * @param unknown $id
     * @return Matchup
     */
    public static function getMatchById($id) {
        // TODO This needs to be updated to reflect the new table structure for courses vs players
        $matchup = new Matchup();
        $data = DBUtils::escapeData(array($id));
        $query = vsprintf(self::GET_MATCH_SQL, $data);
        $result = mysql_query($query) or die("Could not get the match specified ($id)");
        if ($result) {
            $row = mysql_fetch_assoc($result);
            $side = $row["side"];
            $hole = $row["startingHole"];
            $homeTeam = $row["home"];
            $awayTeam = $row["away"];
            $matchId = $row["id"];
            $course = $row["course"];
            $date = $row["date"];

            $matchup->hole = $hole;
            $matchup->id = $matchId;
            $matchup->course = $course;
            $matchup->side = $side;
            $matchup->date = $date;
            array_push($matchup->teams, $homeTeam);
            array_push($matchup->teams, $awayTeam);
        }
        return $matchup;
    }

    /**
     * TODO Document this function
     *
     * @param unknown $date
     * @return Schedule
     */
    public static function getScheduleForDate($date) {
        // TODO This needs to be updated to reflect the new table structure for courses vs players
        $schedule = new Schedule();
        $data = DBUtils::escapeData(array($date));
        $saveHoleData = false;
        $createTeams = false;
        $frontHoles = range(1, 9);
        shuffle($frontHoles);
        $backHoles = range(10, 18);
        shuffle($backHoles);
        $matchSide = "";
        $matchCourse = "";
        $query = vsprintf(self::GET_SCHEDULE_BY_DATE_SQL, $data);
        $result = mysql_query($query) or die("Could not get the schedule of matches by the date specified - $date");
        if ($result) {
            $count = mysql_num_rows($result);
            for ($i = 0; $i < $count; $i++) {
                $row = mysql_fetch_assoc($result);
                $matchup = new Matchup();
                $side = $row["side"];
                $hole = $row["startingHole"];
                $homeTeam = $row["home"];
                $awayTeam = $row["away"];
                $matchDate = $row["date"];
                $matchId = $row["id"];
                $course = $row["course"];

                $matchup->id = $matchId;
                $matchup->course = $course;
                $matchCourse = $course;
                $matchup->side = $side;
                $matchSide = $side;
                $schedule->date = $matchDate;

                if ($homeTeam == 0 && $awayTeam == 0) {
                	$createTeams = true;
                } else {
                	if ($hole == 0) {
                    	if (strpos(strtolower($side), "back") === false) {
                	    	$hole = $frontHoles[$i];
                	    } else {
                		    $hole = $backHoles[$i];
                	    }
                		$saveHoleData = true;
                	}
                    $matchup->hole = $hole;
                    array_push($matchup->teams, $homeTeam);
                    array_push($matchup->teams, $awayTeam);
                    array_push($schedule->matchups, $matchup);
                }
            }
        }

        if ($createTeams) {
        	// get the list of full time members
        	$fulltimePlayers = PlayerDAO::getFulltimePlayers();
        	shuffle($fulltimePlayers);
        	$playerIndex = 0;
        	$saveHoleData = true;
        	$totalPlayers = count($fulltimePlayers);
        	// HARDCODE - only supports 9 hole
        	for ($i = 0; $i < 9; $i++) {
        		if ($playerIndex >= $totalPlayers) {
        			break;
        		}
        		$hole = 0;
        		if (strpos(strtolower($matchSide), "back") === false) {
        			$hole = $frontHoles[$i];
        		} else {
        			$hole = $backHoles[$i];
        		}
        		$matchup = new Matchup();
        		$matchup->id = 0;
        		$matchup->course = $matchCourse;
        		$matchup->side = $matchSide;
        		$matchup->hole = $hole;
        		$homeTeam = $fulltimePlayers[$playerIndex]->id;
        		// increment the player index to get the next player
        		$playerIndex++;
        		// make sure there are enough players to get another
        		if ($playerIndex < $totalPlayers) {
        			$homeTeam = $homeTeam . '^' . $fulltimePlayers[$playerIndex]->id;
        		}
        		array_push($matchup->teams, $homeTeam);
        		// now let's try to get an away team
        		$awayTeam = "";
        		$playerIndex++;
        		// again, make sure there are enough players
        		if ($playerIndex < $totalPlayers) {
        			$awayTeam = $fulltimePlayers[$playerIndex]->id;
        		}
        		// increment the player index to get the next player
        		$playerIndex++;
        		// lastly, make sure there are enough players
        		if ($playerIndex < $totalPlayers) {
        			$awayTeam = $awayTeam . '^' . $fulltimePlayers[$playerIndex]->id;
        		}
        		array_push($matchup->teams, $awayTeam);
        		// put the match into the schedule
        		array_push($schedule->matchups, $matchup);
        		// increment the player index for the next time around
        		$playerIndex++;
        	}
        }

        if ($saveHoleData) {
            foreach ($schedule->matchups as $matchup) {
            	if ($matchup->id == 0) {
            		self::addMatch($matchDate, $matchup->teams[0], $matchup->teams[1], $matchSide, $matchCourse, $matchup->hole);
            		// delete the placeholder
            		$query = sprintf(self::DELETE_PLACEHOLDER_SQL, $matchDate);
            		$result = mysql_query($query);
            	} else {
                    $query = sprintf(self::ASSIGN_HOLE_SQL, $matchup->hole, $matchup->id);
                    $result = mysql_query($query);
            	}
            }
        }

        return $schedule;
    }

    /**
     * TODO Document this function
     *
     * @param unknown $date
     * @return Ambigous <NULL, ScheduleDate>
     */
    public static function getNotesForDate($date) {
        $scheduleDate = null;
        $data = DBUtils::escapeData(array($date));
        $query = vsprintf(self::GET_SCHEDULE_NOTES, $data);
        $result = mysql_query($query) or die("Could not get the notes for the date specified - $date");
        if ($result) {
        	$count = mysql_num_rows($result);
        	if ($count > 0) {
                $row = mysql_fetch_assoc($result);
                $scheduleDate = new ScheduleDate();
                $scheduleDate->date = $row["date"];
                $scheduleDate->notes = $row["notes"];
        	}
        }
        return $scheduleDate;
    }

	public static function deleteNotesForDate($date) {
		$data = DBUtils::escapeData(array($date));
		$query = vsprintf(self::DELETE_SCHEDULE_NOTES, $data);
		$result = @mysql_query($query);
		if (!$result) {
			throw new Exception("Unable to delete the notes - DB : " . mysql_error());
		}
	}

    /**
     * TODO Document this function
     *
     * @param unknown $date
     * @param unknown $notes
     * @param unknown $update
     */
    public static function setNotesForDate($date, $notes, $update) {
        $query = null;
        $data = DBUtils::escapeData(array($notes, $date));
        if ($update) {
            $query = vsprintf(self::UPDATE_SCHEDULE_NOTES, $data);
        } else {
            $query = vsprintf(self::ADD_SCHEDULE_NOTES, $data);
        }
        $result = mysql_query($query) or die("Could not set the notes for the values (date: $date - update: $update - notes: $notes");
    }

    /**
     * TODO Document this function
     *
     * @param unknown $oldDate
     * @param unknown $newDate
     */
    private static function updateNotesDate($oldDate, $newDate) {
        $data = DBUtils::escapeData(array($newDate, $oldDate));
        $query = vsprintf(self::UPDATE_SCHEDULE_NOTES_DATE, $data);
        $result = mysql_query($query) or die("Could not update the notes date. Parameters - old date: $oldDate - new date: $newDate");
    }

    /**
     * TODO Document this function
     *
     * @param unknown $oldDate
     * @param unknown $newDate
     */
    public static function moveScheduledDate($oldDate, $newDate) {
        // TODO This needs to be updated to reflect the new table structure for courses vs players
        $data = DBUtils::escapeData(array($newDate, $oldDate));
        $query = vsprintf(self::UPDATE_SCHEDULE_DATE, $data);
        $result = mysql_query($query) or die("Could not reschedule a date. Parameters - old date: $oldDate - new date: $newDate");

        if ($result) {
            self::updateNotesDate($oldDate, $newDate);
        }
    }

    /**
     * This will add a single date to the schedule.
     *
     * @param Date $date The date of the scheduled match
     * @param Integer $courseId The id of the course that is going to be played
     * @param String $side The side that will be played
     * @throws Exception An exception is thrown if there is an issue adding the date to the database
     */
    public static function addCourseScheduleMatch($date, $courseId, $side, $detailsExist) {
        $data = DBUtils::escapeData(array($date, $courseId, $side, $detailsExist));
        $query = vsprintf(self::ADD_SINGLE_COURSE_SCHEDULE, $data);
        $result = @mysql_query($query);

        if (!$result) {
            throw new Exception("Unable to add a scheduled date for the course - DB : " . mysql_error());
        }
    }

    /**
     * Retrieves a single match by id.
     *
     * @param Integer $matchId The id of the match to retrieve
     * @throws Exception if there is an issue getting the match from the database
     * @return An instance of ScheduleDate if the match was found, otherwise NULL
     */
    public static function getCourseScheduleMatch($matchId) {
        $data = DBUtils::escapeData(array($matchId));
        $query = vsprintf(self::GET_SINGLE_COURSE_SCHEDULE, $data);
        $result = @mysql_query($query);

        $scheduleDate = null;
        if ($result) {
            $count = mysql_num_rows($result);
            if ($count > 0) {
                $row = mysql_fetch_assoc($result);
                $scheduleDate = new ScheduleDate();
                $scheduleDate->id = $row["id"];
                $scheduleDate->date = $row["match_date"];
                $scheduleDate->side = $row["side"];
                $scheduleDate->course = $row["name"];
                $scheduleDate->notes = $row["notes"];
                $scheduleDate->detailsExist = $row["details_exist"];
            }
        } else {
            throw new Exception("Unable to get the scheduled match for the id given - DB : " . mysql_error());
        }

        return $scheduleDate;
    }

    /**
     * Retrieves a single match by date.
     *
     * @param Date $matchDate The date of the match to retrieve
     * @throws Exception if there is an issue getting the match from the database
     * @return An instance of ScheduleDate if the match was found, otherwise NULL
     */
    public static function getCourseScheduleMatchByDate($matchDate) {
        $data = DBUtils::escapeData(array($matchDate));
        $query = vsprintf(self::GET_SINGLE_COURSE_SCHEDULE_BY_DATE, $data);
        $result = @mysql_query($query);

        $scheduleDate = null;
        if ($result) {
            $count = mysql_num_rows($result);
            if ($count > 0) {
                $row = mysql_fetch_assoc($result);
                $scheduleDate = new ScheduleDate();
                $scheduleDate->id = $row["id"];
                $scheduleDate->date = $row["match_date"];
                $scheduleDate->side = $row["side"];
                $scheduleDate->course = $row["name"];
                $scheduleDate->courseId = $row["courseId"];
                $scheduleDate->notes = $row["notes"];
                $scheduleDate->detailsExist = $row["details_exist"];
            }
        } else {
            throw new Exception("Unable to get the scheduled match for the date given - DB : " . mysql_error());
        }

        return $scheduleDate;
    }

    /**
     * Gets the next match that is scheduled.
     *
     * @throws Exception if there is an issue getting the match from the database
     * @return An instance of ScheduleDate if the match was found, otherwise NULL
     */
    public static function getNextCourseScheduleMatch() {
        $result = @mysql_query(self::GET_NEXT_SINGLE_COURSE_SCHEDULE);

        $scheduleDate = null;
        if ($result) {
            $count = mysql_num_rows($result);
            if ($count > 0) {
                $row = mysql_fetch_assoc($result);
                $scheduleDate = new ScheduleDate();
                $scheduleDate->id = $row["id"];
                $scheduleDate->date = $row["match_date"];
                $scheduleDate->side = $row["side"];
                $scheduleDate->course = $row["name"];
                $scheduleDate->notes = $row["notes"];
                $scheduleDate->detailsExist = $row["details_exist"];
            }
        } else {
            throw new Exception("Unable to get the next scheduled match - DB : " . mysql_error());
        }

        return $scheduleDate;
     }

    /**
     * Gets a list of the course scheduled matches between the given dates (inclusive).
     *
     * @param Date $startDate The date to start the search
     * @param Date $endDate The date to end the search
     * @throws Exception if there is an issue getting the list of matches from the database
     * @return A list of ScheduleDate objects
     */
    public static function getCourseScheduleMatches($startDate, $endDate) {
        $data = DBUtils::escapeData(array($startDate, $endDate));
        $query = vsprintf(self::GET_CURRENT_COURSE_SCHEDULE, $data);
        $result = @mysql_query($query);

        $scheduleDates = array();
        if ($result) {
            $count = mysql_num_rows($result);
            for ($i = 0; $i < $count; $i++) {
                $row = mysql_fetch_assoc($result);
                $scheduleDate = new ScheduleDate();
                $scheduleDate->id = $row["id"];
                $scheduleDate->date = $row["match_date"];
                $scheduleDate->side = $row["side"];
                $scheduleDate->course = $row["name"];
                $scheduleDate->notes = $row["notes"];
                $scheduleDate->detailsExist = $row["details_exist"];
                array_push($scheduleDates, $scheduleDate);
            }
        } else {
            throw new Exception("Unable to get the scheduled matches between the dates given - DB : " . mysql_error());
        }
        return $scheduleDates;
    }

    /**
     * Updates the match with the given id.
     *
     * @param Date $date The date that the match should happen
     * @param Integer $courseId The id of the course that the match will take place
     * @param String $side The side of the course that the match will take place
     * @throws Exception If there is an issue updating the database
     */
    public static function updateCourseScheduleMatch($date, $courseId, $side, $detailsExist, $id) {
        $data = DBUtils::escapeData(array($date, $courseId, $side, $detailsExist, $id));
        $query = vsprintf(self::UPDATE_SINGLE_COURSE_SCHEDULE, $data);
        $result = @mysql_query($query);

        if (!$result) {
            throw new Exception("Unable to update a scheduled date for the course - DB : " . mysql_error());
        }
    }

    /**
     * Updates the match details with the given id.
     *
     * @param Integer $id The id of the course schedule
     * @param Boolean $detailsExist The indicator that means that details exist
     * @throws Exception if there is an issue updating the database
     */
    public static function setCourseScheduleDetails($id, $detailsExist) {
        $detailsExist = ($detailsExist) ? 1 : 0;
        $data = DBUtils::escapeData(array($detailsExist, $id));
        $query = vsprintf(self::SET_COURSE_SCHEDULE_DETAILS, $data);
        $result = @mysql_query($query);

        if (!$result) {
            throw new Exception("Unable to update the scheduled date for the course - DB : " . mysql_error());
        }
    }

	/**
	 * Delete the scheduled match given the match id
	 *
	 * @param Integer $matchId The match id to delete
	 * @throws Exception if there is an issue deleting the match from the database
	 */
    public static function deleteCourseScheduleMatch($matchId) {
    	// get a copy of the schedule
    	$schedule = self::getCourseScheduleMatch($matchId);
    	$data = DBUtils::escapeData(array($matchId));
    	$query = vsprintf(self::REMOVE_SINGLE_COURSE_SCHEDULE, $data);
		$result = @mysql_query($query);

		if ($result) {
			self::deleteNotesForDate($schedule->date);
		} else {
			throw new Exception("Unable to delete a scheduled date for the course - DB : " . mysql_error());
		}
    }
}
