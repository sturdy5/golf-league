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

$fileExists = isset($_FILES["handicapFile"]);

if ($fileExists) {
	$dom = DOMDocument::load($_FILES['handicapFile']['tmp_name']);
	$rows = $dom->getElementsByTagName("Row");
	$firstRow = true;
	foreach ($rows as $row) {
		// skip the first row as it is just labels
		if (!$firstRow) {
			$lastName = "";
			$firstName = "";
			$handicap = "";

			$index = 1;
			$cells = $row->getElementsByTagName('Cell');
			foreach ($cells as $cell) {
				$ind = $cell->getAttribute("Index");
				if (null != $ind) {
					$index = $ind;
				}
				if ($index == 1) {
					$lastName = $cell->nodeValue;
				}
				if ($index == 2) {
					$firstName = $cell->nodeValue;
				}
				if ($index == 3) {
					$handicap = $cell->nodeValue;
				}
				$index++;
			}
			
			if (!empty($lastName) && !empty($firstName) && !empty($handicap)) {
			    addHandicap($lastName, $firstName, $handicap);
			}
		}
		$firstRow = false;
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
			<th>Name</th>
			<th>Handicap</th>
			<th>Status</th>
		</tr>
		<?php foreach ($data as $row) {?>
		<tr>
			<td><?=$row['lastName']?>, <?=$row['firstName']?></td>
			<td><?=$row['handicap']?></td>
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
	        <td>Last Name</td>
	        <td>First Name</td>
	        <td>Handicap</td>
	    </tr>
	    <tr>
	    	<td>Player</td>
	    	<td>Joe</td>
	    	<td>10</td>
	    </tr>
	    <tr>
	        <td>Smith</td>
	        <td>John</td>
	        <td>2</td>
	    </tr>
	</table>
	
    <form enctype="multipart/form-data" action="importHandicaps.php" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
	<table class="import">
		<tr>
			<td class="noborder">Handicaps file:</td>
			<td class="noborder"><input type="file" name="handicapFile" /></td>
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
