<?php
include("./requires.inc.php");
include('./../config/loadConfiguration.php');
include('./../validate-admin.php');
include('./../navigation.inc.php');

$data = array();
$overallStatus = "success";
$matchDate = null;

function addDetail($date, $player, $opponent, $startingHole) {
    global $data;
    global $overallStatus;
    global $matchDate;
    $matchDate = $date;
    // lookup the player by name
    $player1name = explode(", ", $player);
    $player2name = explode(", ", $opponent);
    $player1 = PlayerDAO::getPlayerByName($player1name[1], $player1name[0]);
    $player2 = PlayerDAO::getPlayerByName($player2name[1], $player2name[0]);
    $status = "";
    if (null == $player1->id) {
        // the first player wasn't found
        $overallStatus = "failed";
        $status = "1";
    }
    if (null == $player2->id) {
        // the second player wasn't found
        $overallStatus = "failed";
        if ($status == "1") {
            $status = "both";
        } else {
            $status = "2";
        }
    }
    array_push($data, array('player1' => $player, 'player1id' => $player1->id, 'player2' => $opponent, 'player2id' => $player2->id, 'matchDate' => $date, 'startingHole' => $startingHole, 'status' => $status));
    // addMatch($date, $homeTeamId, $awayTeamId, $sideName, $courseId, $hole)
}

$fileExists = isset($_FILES["scheduleDetailFile"]);

if ($fileExists) {
	$dom = DOMDocument::load($_FILES['scheduleDetailFile']['tmp_name']);
	$rows = $dom->getElementsByTagName("Row");
	$firstRow = true;
        $secondRow = false;
        $matchDate = null;
	foreach ($rows as $row) {
		// the first row contains the date in the second column
                if ($firstRow) {
                    // get the date out of the second column
                    $matchDate = $row->getElementsByTagName('Cell')->item(1)->nodeValue;
                    // no longer on the first row
                    $firstRow = false;
                    // but we will be on the second row
                    $secondRow = true;
		} else {
                    // the second row just contains labels, skip it
                    if ($secondRow) {
                        $secondRow = false;
                    } else {
			$cells = $row->getElementsByTagName('Cell');
                        $player1 = $cells->item(0)->nodeValue;
                        $player2 = $cells->item(1)->nodeValue;
                        $startingHole = $cells->item(2)->nodeValue;
			
			if (!empty($player1) && !empty($player2) && !empty($startingHole)) {
			    addDetail($matchDate, $player1, $player2, $startingHole);
			}
                    }
		}
	}
}
?>
<html>
<head>
    <title><?=$config["General"]["siteTitle"]["value"]?></title>
    <link href="/theme/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="./../js/selector.js"></script>
</head>
<body>
<?php  
include_once("../analyticstracking.php");
?>
<div>
<?php 
if ($fileExists) {
    $course = "";
    $side = "";
    if ($overallStatus != "success") {
?>
        <div class="errorMessage">There was a problem finding one or more of the players in the list. Please correct the names below and resubmit</div>
<?php
    } else {
        // need to get the side and the course that this date is for
        $scheduleCourse = ScheduleDAO::getCourseScheduleMatchByDate($matchDate)
        $course = $scheduleCourse->courseId;
        $side = $scheduleCourse->side;
    }
?>
	<table class="import">
		<tr>
			<th>Player 1</th>
			<th>Player 2</th>
			<th>Starting Hole</th>
		</tr>
<?php
		foreach ($data as $row) {
                    $player1class = "normal";
                    $player2class = "normal";
                    $importStatus = $row['status'];
                    if ($importStatus == "both") {
                        $player1class = "failed";
                        $player2class = "failed";
                    } else if ($importStatus == "1") {
                        $player1class = "failed";
                    } else if ($importStatus == "2") {
                        $player2class = "failed";
                    }
                    // if the overall was success, then add it to the database
                    if ($overallStatus == "success") {
                        ScheduleDAO::addMatch($row['matchDate'], $row['player1id'], $row['player2id'], $side, $course, $row['startingHole']);
                    }
?>
		<tr>
                        <td class="<?=$player1class?>"><?=$row['player1']?></td>
			<td class="<?=$player2class?>"><?=$row['player2']?></td>
                        <td><?=$row['startingHole']?></td>
		</tr>
<?php
		}
                // if the overall was success, then we need to flip the flag that says that the course schedule has details
                if ($overallStatus == "success") {
                    ScheduleDAO::setCourseScheduleDetails($scheduleCourse->id, true);
                }
?>
	</table>
<?php
    if ($overallStatus != "success") {
        // need to provide the upload link again
?>
        <form enctype="multipart/form-data" action="importScheduleDetails.php" method="post">
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
            <table class="import">
                <tr>
                    <td class="noborder">Schedule file:</td>
                    <td class="noborder"><input type="file" name="scheduleDetailFile" /></td>
                    <td class="noborder"><input type="submit" value="Upload" /></td>
                </tr>
            </table>
        </form>
<?php
    }
} else {
?>
	<span class="importHandicaps">The format for the excel spreadsheet should be Microsoft Excel XML 2003 with the following layout</span>
	
	<table class="import">
	    <tr>
	        <td>Date</td>
	        <td>2014-04-10</td>
	        <td></td>
	    </tr>
	    <tr>
	    	<td>Player 1</td>
	    	<td>Player 2</td>
	    	<td>Starting Hole</td>
	    </tr>
	    <tr>
	        <td>Smith, John</td>
	        <td>John, Michael</td>
	        <td>1</td>
	    </tr>
            <tr>
                <td>Peters, Joe</td>
                <td>Player, Diane</td>
                <td>1</td>
            </tr>
	</table>
	
    <form enctype="multipart/form-data" action="importScheduleDetails.php" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
	<table class="import">
		<tr>
			<td class="noborder">Schedule file:</td>
			<td class="noborder"><input type="file" name="scheduleDetailFile" /></td>
			<td class="noborder"><input type="submit" value="Upload" /></td>
		</tr>
	</table>
	</form>
<?php 
}
?>
</div>
</body>
</html>
