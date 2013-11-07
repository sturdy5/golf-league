<?php
include("./requires.inc.php");
include("./config/loadConfiguration.php");
include("./validate-admin.php");
?>

<html>
<head>
    <title><?=getConfigValue("General", "siteTitle")?></title>
    <link href="theme/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="./js/selector.js"></script>
</head>
<body onload="fireEvents()">

<?php
include_once("./analyticstracking.php");
include('./navigation.inc.php');
?>

<div class="content">

<script type="text/javascript">
function assignSub() {
    var subIdSelect = document.getElementById("subId");
    var subSelectedIndex = subIdSelect.selectedIndex;
    var subId = subIdSelect.options[subSelectedIndex].value;
    var playerId = document.getElementById("playerId").value;
    document.forms.assignSubForm.matchId.value = '<?=$_POST["matchId"]?>';
    document.forms.assignSubForm.playerId.value = playerId;
    document.forms.assignSubForm.subId.value = subId;
    document.forms.assignSubForm.submit();
}

function goBackToSchedule(date) {
     document.forms.assignSubForm.action = "schedule.php";
     document.forms.assignSubForm.matchDate.value = date;
     document.forms.assignSubForm.submit();
}

var events = new Array();

function fireEvents() {
    for (var i in events) {
        goBackToSchedule(events[i]);
    }
}
</script>
<?php
if ($_POST["matchId"] && $_POST["playerId"] && $_POST["subId"]) {
	ScheduleDAO::assignSub($_POST["matchId"], $_POST["playerId"], $_POST["subId"]);
	$matchup = ScheduleDAO::getMatchById($_POST["matchId"]);
?>
    <script type="text/javascript">
        events.push('<?=$matchup->date?>');
    </script>
<?php
} else {
	$subs = PlayerDAO::getSubs();
	$player = PlayerDAO::getPlayer($_POST["playerId"]);
	if ($player->fulltime == false) {
		// need to get the real player to assign the sub for
		$newPlayerId = ScheduleDAO::getPlayerBySubstitute($_POST["matchId"], $player->id);
		$player = PlayerDAO::getPlayer($newPlayerId);
	}
?>
	<fieldset class="assignSubFields">
		<p>
			<label for="player" class="player">Player that needs a sub:</label> 
			<span class="textbox">
			    <?=$player->firstName?> <?=$player->lastName?>
                <input type="hidden" name="playerId" id="playerId" value="<?=$player->id?>"/>
			</span>
		</p>
		<p>
			<label for="sub" class="sub">Sub:</label>
			<span class="textbox">
			    <select name="subId" id="subId">
<?php 
                    foreach ($subs as $sub) {
?>
                        <option value="<?=$sub->id?>"><?=$sub->lastName?>, <?=$sub->firstName?></option>
<?php 
                    }
?>
                </select>
			</span>
		</p>
		
		<div id="alignRight">
			<label for="submit">
			    <input name="submit" type="button" value="Assign" onclick="assignSub()"/>
			</label>
		</div>
	</fieldset>
<?php
}
?>

<form name="assignSubForm" id="assignSubForm" method="POST" action="assignSubs.php">
    <input type="hidden" name="subId" id="subId" value=""/>
    <input type="hidden" name="matchId" id="matchId" value=""/>
    <input type="hidden" name="playerId" id="playerId" value=""/>
    <input type="hidden" name="matchDate" id="matchDate" value=""/>
</form>
</div>
<?php
include('./utilities.inc.php');
?>
<?php
include('./footer.inc.php');
?>