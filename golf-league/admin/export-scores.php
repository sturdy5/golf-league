<?php
include("./requires.inc.php");
include('../validate-admin.php');
if (!isset($_GET["matchDate"])) {
    header("location: /index.php");
}

$matchDate = $_GET["matchDate"];
$schedule = ScheduleDAO::getScheduleForDate($matchDate);
$excelData = array();
$header = array();
foreach ($schedule->matchups as $sampleMatch) {
    $holes = CourseDAO::getHolesPerSide($sampleMatch->course, $sampleMatch->side);
    array_push($header, "Name");
    foreach ($holes as $hole) {
        array_push($header, $hole->number);
    }
    array_push($excelData, $header);
    break;
}
foreach ($schedule->matchups as $match) {
    $matchId = $match->id;

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

    $rowData = array();
    array_push($rowData, $hometeam->players[$homeIndex1]->firstName . " " . $hometeam->players[$homeIndex1]->lastName);
    foreach ($holes as $hole) {
        array_push($rowData, $home1scores->scores[$hole->number]);
    }
    array_push($excelData, $rowData);

    $rowData2 = array();
    array_push($rowData2, $awayteam->players[$awayIndex1]->firstName . " " . $awayteam->players[$awayIndex1]->lastName);
    foreach ($holes as $hole) {
        array_push($rowData2, $away1scores->scores[$hole->number]);
    }
    array_push($excelData, $rowData2);

    $rowData3 = array();
    array_push($rowData3, $hometeam->players[$homeIndex2]->firstName . " " . $hometeam->players[$homeIndex2]->lastName);
    foreach ($holes as $hole) {
        array_push($rowData3, $home2scores->scores[$hole->number]);
    }
    array_push($excelData, $rowData3);

    $rowData4 = array();
    array_push($rowData4, $awayteam->players[$awayIndex2]->firstName . " " . $awayteam->players[$awayIndex2]->lastName);
    foreach ($holes as $hole) {
        array_push($rowData4, $away2scores->scores[$hole->number]);
    }
    array_push($excelData, $rowData4);
}

$filename = $matchDate . "_scores.xls";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

foreach ($excelData as $row) {
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\r\n";
}

// Original PHP code by Chirp Internet: www.chirp.com.au
// Please acknowledge use of this code by including this header.

function cleanData(&$str)
{
    // escape tab characters
    $str = preg_replace("/\t/", "\\t", $str);

    // escape new lines
    $str = preg_replace("/\r?\n/", "\\n", $str);

    // convert 't' and 'f' to boolean values
    if($str == 't') $str = 'TRUE';
    if($str == 'f') $str = 'FALSE';

    // force certain number/date formats to be imported as strings
    if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
        $str = "'$str";
    }

    // escape fields that include double quotes
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

?>