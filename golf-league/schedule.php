<?php
include('./header.inc.php');
require_once("./dao/DBUtils.php");
require_once("./dao/ScheduleDAO.php");
require_once("./dao/PlayerDAO.php");
require_once("./dao/TeamDAO.php");
require_once("./model/Schedule.php");
require_once("./model/ScheduleDate.php");
require_once("./model/Matchup.php");
require_once("./model/Team.php");
require_once("./model/Player.php");
require_once("./utils/ArrayUtils.php");
?>

<?php
include('./navigation.inc.php');
?>

<div class="content">

<script type="text/javascript">
function submitDate(matchDate) {
    document.forms.scheduleForm.matchDate.value = matchDate;
    document.forms.scheduleForm.submit();
}

function assignSub(matchId, playerId) {
     document.forms.scheduleForm.matchId.value = matchId;
     document.forms.scheduleForm.playerId.value = playerId;
     document.forms.scheduleForm.action = "assignSubs.php";
     document.forms.scheduleForm.submit();
}

function removeSub(matchId, subId) {
    document.forms.scheduleForm.matchId.value = matchId;
    document.forms.scheduleForm.playerId.value = subId;
    document.forms.scheduleForm.action = "removeSub.php";
    document.forms.scheduleForm.submit();
}
</script>

<?php
function sortMatchupByHole($a, $b) {
    return ($a->hole < $b->hole) ? -1 : 1;
}

$userId = $_SESSION['userid'];

if ($_POST["matchDate"]) {
	$schedule = ScheduleDAO::getScheduleForDate($_POST["matchDate"]);
    usort($schedule->matchups, "sortMatchupByHole");
?>
    <div class="matchups">
        <div class="matchDate"><?=$_POST["matchDate"]?>
<?php
            if ($_SESSION["admin"] == 1) { 
?>
            - <a href="admin/export-scores.php?matchDate=<?=$_POST["matchDate"]?>">Export Scores</a>
<?php 
            }
?>
        </div>
<?php
    	
	foreach ($schedule->matchups as $matchup) {
		$homeTeamId = $matchup->teams[0];
		$awayTeamId = $matchup->teams[1];
		$hole = $matchup->hole;
		
		// get the team information
		$homeTeam = TeamDAO::getTeamById($homeTeamId);
		$awayTeam = TeamDAO::getTeamById($awayTeamId);
		
		// need to check for a sub for each player
		$matchId = $matchup->id;
		$playerId = $homeTeam->players[0]->id;
		$subId = ScheduleDAO::getMatchSubstitute($matchId, $playerId);
		if (null != $subId) {
		    $player = PlayerDAO::getPlayer($subId);
		    $homeTeam->players[0] = $player;
		}
		
		$playerId = $homeTeam->players[1]->id;
		$subId = ScheduleDAO::getMatchSubstitute($matchId, $playerId);
		if (null != $subId) {
		    $player = PlayerDAO::getPlayer($subId);
		    $homeTeam->players[1] = $player;
		}
		
		$playerId = $awayTeam->players[0]->id;
		$subId = ScheduleDAO::getMatchSubstitute($matchId, $playerId);
		if (null != $subId) {
		    $player = PlayerDAO::getPlayer($subId);
		    $awayTeam->players[0] = $player;
		}
		
		$playerId = $awayTeam->players[1]->id;
		$subId = ScheduleDAO::getMatchSubstitute($matchId, $playerId);
		if (null != $subId) {
		    $player = PlayerDAO::getPlayer($subId);
		    $awayTeam->players[1] = $player;
		}
		
?>
    <table class="matchup">
        <tr>
            <th>Hole</th>
            <th colspan="2"><?=$homeTeam->name?></th>
            <th colspan="2"><?=$awayTeam->name?></th>
<?php 
            if (isset($userId) && ($userId == $homeTeam->players[0]->id || $userId == $homeTeam->players[1]->id || $userId == $awayTeam->players[0]->id || $userId == $awayTeam->players[1]->id || $_SESSION["admin"] == 1)) {
?>
                <td class="hole" rowspan="3"><a href="/member/scorecard.php?matchId=<?=$matchId?>">Score Card</a></td>
<?php 
            }
?>
        </tr>
        <tr>
            <td rowspan="2" class="hole"><?=$hole?></td>
<?php 
			$homeHandicap1 = $homeTeam->players[0]->handicap;
			$homeHandicap2 = $homeTeam->players[1]->handicap;
			$awayHandicap1 = $awayTeam->players[0]->handicap;
			$awayHandicap2 = $awayTeam->players[1]->handicap;
			
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
?>
            <td class="player">
                <div><?=$homeTeam->players[$homeIndex1]->firstName?> <?=$homeTeam->players[$homeIndex1]->lastName?></div>
<?php
                if ($_SESSION["admin"] == 1) {
                	if ($homeTeam->players[$homeIndex1]->fulltime) {
?>
                    <div><a href="#" onclick="assignSub('<?=$matchId?>', '<?=$homeTeam->players[$homeIndex1]->id?>');return false;">assign sub</a></div>
<?php
                	} else {
?>
                    <div><a href="#" onclick="removeSub('<?=$matchId?>', '<?=$homeTeam->players[$homeIndex1]->id?>');return false;">remove sub</a></div>
<?php
                	}
                }
?>
            </td>
            <td class="handicap"><?=$homeTeam->players[$homeIndex1]->handicap?></td>
            <td class="player">
                <div><?=$awayTeam->players[$awayIndex1]->firstName?> <?=$awayTeam->players[$awayIndex1]->lastName?></div>
<?php
                if ($_SESSION["admin"] == 1) {
                	if ($awayTeam->players[$awayIndex1]->fulltime) {
?>
                    <div><a href="#" onclick="assignSub('<?=$matchId?>', '<?=$awayTeam->players[$awayIndex1]->id?>');return false;">assign sub</a></div>
<?php
                	} else {
?>
                    <div><a href="#" onclick="removeSub('<?=$matchId?>', '<?=$awayTeam->players[$awayIndex1]->id?>');return false;">remove sub</a></div>
<?php
                	}
                }
?>
            </td>
            <td class="handicap"><?=$awayTeam->players[$awayIndex1]->handicap?></td>
        </tr>
        <tr>
            <td class="player">
                <div><?=$homeTeam->players[$homeIndex2]->firstName?> <?=$homeTeam->players[$homeIndex2]->lastName?></div>
<?php
                if ($_SESSION["admin"] == 1) {
                	if ($homeTeam->players[$homeIndex2]->fulltime) {
?>
                    <div><a href="#" onclick="assignSub('<?=$matchId?>', '<?=$homeTeam->players[$homeIndex2]->id?>');return false;">assign sub</a></div>
<?php
                	} else {
?>
                    <div><a href="#" onclick="removeSub('<?=$matchId?>', '<?=$homeTeam->players[$homeIndex2]->id?>');return false;">remove sub</a></div>
<?php
                	}
                }
?>
            </td>
            <td class="handicap"><?=$homeTeam->players[$homeIndex2]->handicap?></td>
            <td class="player">
                <div><?=$awayTeam->players[$awayIndex2]->firstName?> <?=$awayTeam->players[$awayIndex2]->lastName?></div>
<?php
                if ($_SESSION["admin"] == 1) {
                	if ($awayTeam->players[$awayIndex2]->fulltime) {
?>
                    <div><a href="#" onclick="assignSub('<?=$matchId?>', '<?=$awayTeam->players[$awayIndex2]->id?>');return false;">assign sub</a></div>
<?php
                	} else {
?>
                    <div><a href="#" onclick="removeSub('<?=$matchId?>', '<?=$awayTeam->players[$awayIndex2]->id?>');return false;">remove sub</a></div>
<?php
                	}
                }
?>
            </td>
            <td class="handicap"><?=$awayTeam->players[$awayIndex2]->handicap?></td>
        </tr>
    </table>
<?php
	}
?>
    </div>
<?php
} else {
	$dates = ScheduleDAO::getScheduledDates();
?>
    <div class="schedule">
        Please select a date below for the schedule:<br/>
<?php
	foreach ($dates as $date) {
?>
        <div class="match-date">
<?php
            if ($_SESSION["admin"] == 1) {
?>
                <a href="admin/updateScheduleNotes.php?date=<?=$date->date?>">Modify</a> - 
<?php 
            }
?>
            <a href="#" onclick="submitDate('<?=$date->date?>');return false;"><?=$date->date?></a> <?=$date->notes?>
        </div>
<?php
	}
?>
    </div>
<?php
}
?>

<form name="scheduleForm" id="scheduleForm" method="POST" action="schedule.php">
    <input type="hidden" name="matchDate" id="matchDate" value=""/>
    <input type="hidden" name="matchId" id="matchId" value=""/>
    <input type="hidden" name="playerId" id="playerId" value=""/>
</form>
</div>
<?php
include('./utilities.inc.php');
?>
<?php
include('./footer.inc.php');
?>