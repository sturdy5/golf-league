<?php
require_once("./../config.inc.php");
require_once("../dao/DBUtils.php");
require_once("../dao/ScheduleDAO.php");
require_once("../dao/PlayerDAO.php");
require_once("../dao/TeamDAO.php");
require_once("../dao/CourseDAO.php");
require_once("../dao/ScoreDAO.php");
require_once("../model/Schedule.php");
require_once("../model/Matchup.php");
require_once("../model/Team.php");
require_once("../model/Player.php");
require_once("../model/Course.php");
require_once("../model/Hole.php");
require_once("../model/Scores.php");
require_once("../model/Tee.php");
require_once("./../utils/ArrayUtils.php");
//include('../validate-member.php');
if (!isset($_GET["matchId"])) {
	header("location: /index.php");
}
include('../navigation.inc.php');

$matchId = $_GET["matchId"];
$success = $_GET["success"];

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

$home1scores = ScoreDAO::getScoresByMatchIdAndPlayer($matchId, $hometeam->players[$homeIndex1]->id);
$home2scores = ScoreDAO::getScoresByMatchIdAndPlayer($matchId, $hometeam->players[$homeIndex2]->id);
$away1scores = ScoreDAO::getScoresByMatchIdAndPlayer($matchId, $awayteam->players[$awayIndex1]->id);
$away2scores = ScoreDAO::getScoresByMatchIdAndPlayer($matchId, $awayteam->players[$awayIndex2]->id);

?>
<html>
<head>
    <title>Thursday Night Golf League</title>
    <link href="/theme/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="./../js/selector.js"></script>
    <script type="text/javascript">
        function updateTotal(teamId, playerId, hole) {
            var holes = new Array();
<?php 
            foreach ($holes as $hole) {
            	echo "holes.push('$hole->number');";
            }
?>
            var total = 0;
            for (var i = 0; i < holes.length; i++) {
                var holeValue = parseInt(document.getElementById("player-" + playerId + "_hole-" + holes[i]).value, 10);
                if (!isNaN(holeValue)) {
                	total += holeValue;
                }
            }

            document.getElementById("player-" + playerId + "_total").value = total;
        }

        function submitScores() {
            // TODO - need to add something that will verify all of the fields are filled in
            document.forms.scorecardForm.submit();
        }
    </script>
</head>
<body>
<div class="content">
<?php 
    if (isset($success) && $success == "1") {
    	echo "Score Card Successfully Saved";
    }
?>
    <form name="scorecardForm" id="scorecardForm" method="POST" action="save-scorecard.php">
    <input type="hidden" name="matchId" id="matchId" value="<?=$match->id?>"/>
    <table class="scorecard">
        <tr>
            <td colspan="7" class="course"><?=$course->name?></td>
            <td colspan="4" class="course"><?=$match->date?></td>
        </tr>
        <tr>
            <th>Hole</th>
<?php 
            foreach ($holes as $hole) {
?>
            <td><?=$hole->number?></td>
<?php 
            }
?>
            <td>Total</td>
        </tr>
        <tr>
            <th>Men's Handicap</th>
<?php 
            foreach ($holes as $hole) {
?>
            <td><?=$hole->mensHandicap?></td>
<?php 
            }
?>
            <td></td>
        </tr>
        <tr>
            <th>Women's Handicap</th>
<?php 
            foreach ($holes as $hole) {
?>
            <td><?=$hole->womensHandicap?></td>
<?php 
            }
?>
            <td></td>
        </tr>
        <tr>
            <th>Par</th>
<?php 
            $totalPar = 0;
            foreach ($holes as $hole) {
?>
            <td><?=$hole->par?></td>
<?php 
                $totalPar += $hole->par;
            }
?>
            <td><?=$totalPar?></td>
        </tr>
        <tr>
            <td colspan="11" class="spacer"> </td>
        </tr>
        <tr>
            <th><?=$hometeam->name?> - <?=$hometeam->players[$homeIndex1]->firstName?> <?=$hometeam->players[$homeIndex1]->lastName?> (<?=$hometeam->players[$homeIndex1]->handicap?>)</th>
<?php 
            $holeTotal = 0;
            foreach ($holes as $hole) {
            	$holeValue = "";
            	if (isset($home1scores->scores[$hole->number])) {
            		$holeValue = $home1scores->scores[$hole->number];
            		if (is_numeric($holeValue)) {
            			$holeTotal += $holeValue;
            		}
            	}
?>
            <td><input type="text" name="player-<?=$hometeam->players[$homeIndex1]->id?>_hole-<?=$hole->number?>" id="player-<?=$hometeam->players[$homeIndex1]->id?>_hole-<?=$hole->number?>" value="<?=$holeValue?>" size="2" onchange="updateTotal('<?=$hometeam->id?>', '<?=$hometeam->players[$homeIndex1]->id?>', '<?=$hole->number?>')"/></td>
<?php 
            }
?>
            <td><input type="text" name="player-<?=$hometeam->players[$homeIndex1]->id?>_total" id="player-<?=$hometeam->players[$homeIndex1]->id?>_total" value="<?=$holeTotal?>" size="2" readonly="readonly"/></td>
        </tr>
        <tr>
            <th><?=$awayteam->name?> - <?=$awayteam->players[$awayIndex1]->firstName?> <?=$awayteam->players[$awayIndex1]->lastName?> (<?=$awayteam->players[$awayIndex1]->handicap?>)</th>
<?php 
            $holeTotal = 0;
            foreach ($holes as $hole) {
            	$holeValue = "";
            	if (isset($away1scores->scores[$hole->number])) {
            		$holeValue = $away1scores->scores[$hole->number];
            		if (is_numeric($holeValue)) {
            			$holeTotal += $holeValue;
            		}
            	}
?>
            <td><input type="text" name="player-<?=$awayteam->players[$awayIndex1]->id?>_hole-<?=$hole->number?>" id="player-<?=$awayteam->players[$awayIndex1]->id?>_hole-<?=$hole->number?>" value="<?=$holeValue?>" size="2" onchange="updateTotal('<?=$awayteam->id?>', '<?=$awayteam->players[$awayIndex1]->id?>', '<?=$hole->number?>')"/></td>
<?php 
            }
?>
            <td><input type="text" name="player-<?=$awayteam->players[$awayIndex1]->id?>_total" id="player-<?=$awayteam->players[$awayIndex1]->id?>_total" value="<?=$holeTotal?>" size="2" readonly="readonly"/></td>
        </tr>
        <tr>
            <td colspan="11" class="spacer"> </td>
        </tr>
        <tr>
            <th><?=$hometeam->name?> - <?=$hometeam->players[$homeIndex2]->firstName?> <?=$hometeam->players[$homeIndex2]->lastName?> (<?=$hometeam->players[$homeIndex2]->handicap?>)</th>
<?php 
            $holeTotal = 0;
            foreach ($holes as $hole) {
            	$holeValue = "";
            	if (isset($home2scores->scores[$hole->number])) {
            		$holeValue = $home2scores->scores[$hole->number];
            		if (is_numeric($holeValue)) {
            			$holeTotal += $holeValue;
            		}
            	}
?>
            <td><input type="text" name="player-<?=$hometeam->players[$homeIndex2]->id?>_hole-<?=$hole->number?>" id="player-<?=$hometeam->players[$homeIndex2]->id?>_hole-<?=$hole->number?>" value="<?=$holeValue?>" size="2" onchange="updateTotal('<?=$hometeam->id?>', '<?=$hometeam->players[$homeIndex2]->id?>', '<?=$hole->number?>')"/></td>
<?php 
            }
?>
            <td><input type="text" name="player-<?=$hometeam->players[$homeIndex2]->id?>_total" id="player-<?=$hometeam->players[$homeIndex2]->id?>_total" value="<?=$holeTotal?>" size="2"/></td>
        </tr>
        <tr>
            <th><?=$awayteam->name?> - <?=$awayteam->players[$awayIndex2]->firstName?> <?=$awayteam->players[$awayIndex2]->lastName?> (<?=$awayteam->players[$awayIndex2]->handicap?>)</th>
<?php 
            $holeTotal = 0;
            foreach ($holes as $hole) {
            	$holeValue = "";
            	if (isset($away2scores->scores[$hole->number])) {
            		$holeValue = $away2scores->scores[$hole->number];
            		if (is_numeric($holeValue)) {
            			$holeTotal += $holeValue;
            		}
            	}
?>
            <td><input type="text" name="player-<?=$awayteam->players[$awayIndex2]->id?>_hole-<?=$hole->number?>" id="player-<?=$awayteam->players[$awayIndex2]->id?>_hole-<?=$hole->number?>" value="<?=$holeValue?>" size="2" onchange="updateTotal('<?=$awayteam->id?>', '<?=$awayteam->players[$awayIndex2]->id?>', '<?=$hole->number?>')"/></td>
<?php 
            }
?>
            <td><input type="text" name="player-<?=$awayteam->players[$awayIndex2]->id?>_total" id="player-<?=$awayteam->players[$awayIndex2]->id?>_total" value="<?=$holeTotal?>" size="2" readonly="readonly"/></td>
        </tr>
        <tr>
            <td colspan="11" class="controls"><input type="button" value="Submit" name="submitScoresButton" id="submitScoresButton" onclick="submitScores()"/></td>
    </table>
    </form>
</div>
<?php
include('./../utilities.inc.php'); 
?>
<?php
include('./../footer.inc.php');
?>