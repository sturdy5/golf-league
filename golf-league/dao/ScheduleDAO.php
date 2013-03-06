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

    const GET_SEASON_SQL = "select id, startDate, endDate from seasons where startDate < CURDATE() and endDate > CURDATE()";
    const CREATE_SEASON_SQL = "insert into seasons (startDate, endDate, courseId, team_structure, score_style) values ('%s', '%s', %s, '%s', '%s')";
    const GET_LAST_SEASON_SQL = "select id, startDate, endDate from seasons where endDate < CURDATE() order by endDate desc limit 0, 1";
    const GET_SEASON_BY_DATE_SQL = "select * from seasons where startDate <= '%s' and endDate >= '%s'";
    const GET_COURSE_BY_SEASON_SQL = "select courseId from seasons where id = %s";
    const GET_UNIQUE_DATES_SQL = "select distinct s.date, n.notes from schedule s left join schedule_notes n on s.date = n.date where s.date > '%s' and s.date < '%s' order by s.date asc";
    const UPDATE_SCHEDULE_NOTES = "update schedule_notes set notes = '%s' where date = '%s'";
    const ADD_SCHEDULE_NOTES = "insert into schedule_notes (notes, date) values ('%s', '%s')";
    const GET_SCHEDULE_NOTES = "select * from schedule_notes where date = '%s'";
    const UPDATE_SCHEDULE_NOTES_DATE = "update schedule_notes set date = '%s' where date = '%s'";
    const UPDATE_SCHEDULE_DATE = "update schedule set date = '%s' where date = '%s'";
    const GET_SCHEDULE_BY_DATE_SQL = "select * from schedule where date = '%s'";
    const GET_SUBS_BY_MATCH_SQL = "select * from schedule_subs where match_id = %s and player_id = %s";
    const GET_PLAYER_BY_MATCH_AND_SUB_SQL = "select * from schedule_subs where match_id = %s and sub_id = %s";
    const ASSIGN_SUBS_SQL = "insert into schedule_subs (sub_id, match_id, player_id) values (%s, %s, %s)";
    const REMOVE_SUB_SQL = "delete from schedule_subs where match_id = %s and sub_id = %s";
    const UPDATE_SUBS_SQL = "update schedule_subs set sub_id = %s where match_id = %s and player_id = %s";
    const ASSIGN_HOLE_SQL = "update schedule set startingHole = %s where id = %s";
    const ADD_SCHEDULE_SQL = "insert into schedule (date, home, away, side, startingHole) values ('%s', %s, %s, '%s', 0)";
    const GET_MATCH_SQL = "select * from schedule where id = %s";

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
    	// the first step to that is to get the sides for the course
    	$sides = CourseDAO::getCourseSides($courseId);
    	
    	// now let's assume for now that all scheduled dates will be on Thursdays
    	// TODO figure out how to determine all of the thursdays between the start date
    	// and the end date (inclusive).
    	
    	return $seasonId;
    }
    
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
    
    public static function getScheduledDates() {
        $dates = array();
        $seasonId = "none";
        $startDate = null;
        $endDate = null;
        $result = mysql_query(self::GET_SEASON_SQL) or die("Could not determine the season that is currently in session");
        if ($result) {
            $row = mysql_fetch_assoc($result);
            $seasonId = $row["id"];
            $startDate = $row["startDate"];
            $endDate = $row["endDate"];
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
            $query = sprintf(self::GET_UNIQUE_DATES_SQL, $startDate, $endDate);
            $result = mysql_query($query);
            if ($result) {
                $count = mysql_num_rows($result);
                for ($i = 0; $i < $count; $i++) {
                    $row = mysql_fetch_assoc($result);
                    $scheduleDate = new ScheduleDate();
                    $scheduleDate->date = $row["date"];
                    $scheduleDate->notes = $row["notes"];
                    array_push($dates, $scheduleDate);
                }
            }
        }

        return $dates;
    }
    
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
    
    public static function removeMatchSubstitute($matchId, $subId) {
    	$data = DBUtils::escapeData(array($matchId, $subId));
    	$query = vsprintf(self::REMOVE_SUB_SQL, $data);
    	$result = mysql_query($query) or die("Couldn't remove the sub");
    }
    
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

    public static function getMatchById($id) {
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

    public static function getScheduleForDate($date) {
        $schedule = new Schedule();
        $data = DBUtils::escapeData(array($date));
        $saveHoleData = false;
        $query = vsprintf(self::GET_SCHEDULE_BY_DATE_SQL, $data);
        $result = mysql_query($query) or die("Could not get the schedule of matches by the date specified - $date");
        if ($result) {
            $count = mysql_num_rows($result);
            $frontHoles = range(1, $count);
            shuffle($frontHoles);
            $backHoles = range(10, (9 + $count));
            shuffle($backHoles);
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
                 
                if ($hole == 0) {
                    if (strcasecmp($side, "back") == 0) {
                        $hole = $backHoles[$i];
                    } else {
                        $hole = $frontHoles[$i];
                    }
                    $saveHoleData = true;
                }
                $matchup->hole = $hole;
                $matchup->id = $matchId;
                $matchup->course = $course;
                $matchup->side = $side;
                array_push($matchup->teams, $homeTeam);
                array_push($matchup->teams, $awayTeam);
                 
                $schedule->date = $matchDate;
                array_push($schedule->matchups, $matchup);
            }
        }
         
        if ($saveHoleData) {
            foreach ($schedule->matchups as $matchup) {
                $query = sprintf(self::ASSIGN_HOLE_SQL, $matchup->hole, $matchup->id);
                $result = mysql_query($query);
            }
        }
         
        return $schedule;
    }

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
    
    private static function updateNotesDate($oldDate, $newDate) {
        $data = DBUtils::escapeData(array($newDate, $oldDate));
        $query = vsprintf(self::UPDATE_SCHEDULE_NOTES_DATE, $data);
        $result = mysql_query($query) or die("Could not update the notes date. Parameters - old date: $oldDate - new date: $newDate");
    }
    
    public static function moveScheduledDate($oldDate, $newDate) {
        $data = DBUtils::escapeData(array($newDate, $oldDate));
        $query = vsprintf(self::UPDATE_SCHEDULE_DATE, $data);
        $result = mysql_query($query) or die("Could not reschedule a date. Parameters - old date: $oldDate - new date: $newDate");
        
        if ($result) {
            self::updateNotesDate($oldDate, $newDate);
        }
    }
}