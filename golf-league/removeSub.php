<?php
require_once('./config.inc.php');
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
include("./validate-admin.php");
?>

<html>
<head>
    <title>Thursday Night Golf League</title>
    <link href="theme/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="./js/selector.js"></script>
</head>
<body onload="fireEvents()">

<?php
include('./navigation.inc.php');
?>

<div class="content">

<script type="text/javascript">
function goBackToSchedule(date) {
     document.forms.removeSubForm.action = "schedule.php";
     document.forms.removeSubForm.matchDate.value = date;
     document.forms.removeSubForm.submit();
}

var events = new Array();

function fireEvents() {
    for (var i in events) {
        goBackToSchedule(events[i]);
    }
}
</script>
<?php
if ($_POST["matchId"] && $_POST["playerId"]) {
	ScheduleDAO::removeMatchSubstitute($_POST["matchId"], $_POST["playerId"]);
	$matchup = ScheduleDAO::getMatchById($_POST["matchId"]);
?>
    <script type="text/javascript">
        events.push('<?=$matchup->date?>');
    </script>
<?php
}
?>

<form name="removeSubForm" id="removeSubForm" method="POST" action="removeSub.php">
    <input type="hidden" name="matchDate" id="matchDate" value=""/>
</form>
</div>

<?php
include('./utilities.inc.php');
?>
<?php
include('./footer.inc.php');
?>