<?php
include("./requires.inc.php");
include('./../config/loadConfiguration.php');
include('./../validate-admin.php');
include('./../navigation.inc.php');

$data = array();

function addHandicap($lastName, $firstName, $handicap) {
	global $data;
	$player = PlayerDAO::getPlayerByName($firstName, $lastName);
	$successMessage = "successfully updated";
	if (null == $player->id) {
		$successMessage = "failed to update because player could not be found";
	} else {
		PlayerDAO::assignPlayerHandicap($player->id, $handicap);
	}
	$data[] = array('lastName' => $lastName, 'firstName' => $firstName, 'handicap' => $handicap, 'status' => $successMessage);
}

function addDetail($date, $player, $opponent, $startingHole) {
    
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
                    $matchDate = $row->getElementsByTagName('Cell')[1]->nodeValue;
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
                        $player1 = $cells[0]->nodeValue;
                        $player2 = $cells[1]->nodeValue;
                        $startingHole = $cells[2]->nodeValue;
			
			if (!empty($player1)&& !empty($player2) && !empty($startingHole)) {
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
?>
	<table class="import">
		<tr>
			<th>Player 1</th>
			<th>Player 2</th>
			<th>Starting Hole</th>
		</tr>
		<?php foreach ($data as $row) {?>
		<tr>
			<td><?=$row['player1']?></td>
			<td><?=$row['player2']?></td>
			<td><?=$row['status']?></td>
		</tr>
		<?php }?>
	</table>
<?php 
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
