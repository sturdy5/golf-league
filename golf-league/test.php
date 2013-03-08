<?php
require_once("./config.inc.php");
require_once("./dao/DBUtils.php");
require_once("./dao/ScheduleDAO.php");
require_once("./dao/PlayerDAO.php");
require_once("./dao/TeamDAO.php");
require_once("./model/Schedule.php");
require_once("./model/Matchup.php");
require_once("./model/Team.php");
require_once("./model/Player.php");
require_once("./utils/ArrayUtils.php");

//$teams = TestDAO::getTeamById(8);
//$player = $teams->players[1];
//echo "$player->firstName $player->lastName : $player->handicap";

$startDate = "2013-03-14";
$endDate = "2013-05-20";

$date = new DateTime($startDate);
$stopDate = new DateTime($endDate);

while ($date <= $stopDate) {
	// check to see if it is a thursday
	$dayOfWeek = date("w", $date->getTimestamp());
	if ($dayOfWeek == 4) {
		echo $date->format("Y-m-d") . ' is a Thursday';
		echo "<br/>";
		
	}
	$date = $date->modify("+1 day");
}

class TestDAO {

    const LOOKUP_TEAMS_SQL = "select * from teams order by id asc";
    const LOOKUP_TEAM_BY_TEAM_ID_SQL = "select * from teams where id = %s";
    const ADD_TEAM_SQL = "insert into teams (name, players) values ('%s', '%s')";
    const DELETE_TEAM_SQL = "delete from teams where id = %s";

    public static function getAllTeams() {

        $teams = array();

        $result = mysql_query(self::LOOKUP_TEAMS_SQL) or die("No teams have been defined");
        // create team objects from the results and store it in a list to be returned
        while ($row = mysql_fetch_array($result)) {
            $team = new Team();
            // id
            $team->id = $row["id"];
            $team->name = $row["name"];
            /*
             * Using array_filter so that in the situation where there are no players
            * the array won't be of size 1, it will be size 0.
            */
            $team->players = array_filter(explode(",", $row["players"]));
            array_push($teams, $team);
        }

        foreach($teams as $team) {
            // need to get the actual players for the team
            $newplayers = array();
            foreach($team->players as $player) {
                $newplayer = PlayerDAO::getPlayer($player);
                array_push($newplayers, $newplayer);
            }
            $team->players = $newplayers;
        }

        return $teams;
    }

    public static function getTeamById($teamId) {
        $query = sprintf(self::LOOKUP_TEAM_BY_TEAM_ID_SQL, $teamId);
        $result = mysql_query($query) or die("No teams have been defined for id = $teamId");
        
        // create team objects from the results
        $team = new Team();
        if ($result) {
        	$row = mysql_fetch_assoc($result);
            // id
            $team->id = $row["id"];
            $team->name = $row["name"];
            /*
             * Using array_filter so that in the situation where there are no players
             * the array won't be of size 1, it will be size 0.
             */
            $team->players = array_filter(explode(",", $row["players"]));
            
            // need to get the actual players for the team
            $newplayers = array();
            foreach($team->players as $player) {
                $newplayer = PlayerDAO::getPlayer($player);
                array_push($newplayers, $newplayer);
            }
            $team->players = $newplayers;
        }
        
        return $team;
    }

    public static function addTeamByPlayer($name, $players) {
        $playerIdsArray = array();
        foreach ($players as $player) {
            array_push($playerIdsArray, $player->id);
        }
        $playerIds = implode(",", $playerIdsArray);
        return self::addTeamByIds($name, $playerIds);
    }

    public static function addTeamByIds($name, $playerIds) {
        $data = array($name, $playerIds);
        $data = DBUtils::escapeData($data);
        
        $query = vsprintf(self::ADD_TEAM_SQL, $data);

        $result = mysql_query($query);

        $teamId = "";

        if ($result) {
            $teamId = mysql_insert_id();
        } else {
            throw new Exception("DB : " . mysql_error());
        }

        return $teamId;
    }
    
    public static function deleteTeam($id) {
        $data = DBUtils::escapeData(array($id));
        $query = vsprintf(self::DELETE_TEAM_SQL, $data);
        $result = mysql_query($query);
        
        $returnValue = false;
        if ($result) {
            $returnValue = true;
        } else {
            throw new Exception("DB : " . mysql_error());
        }
        
        return $returnValue;
    }
}

?>