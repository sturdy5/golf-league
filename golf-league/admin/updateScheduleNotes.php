<?php
require_once("./../config.inc.php");
require_once("./../dao/DBUtils.php");
require_once("./../dao/ScheduleDAO.php");
require_once("./../dao/PlayerDAO.php");
require_once("./../dao/TeamDAO.php");
require_once("./../model/Schedule.php");
require_once("./../model/ScheduleDate.php");
require_once("./../model/Matchup.php");
require_once("./../model/Team.php");
require_once("./../model/Player.php");
require_once("./../utils/ArrayUtils.php");
include('./../validate-admin.php');
include('./../navigation.inc.php');
?>
<html>
<head>
    <title>Bogey Club - Thursday Night Golf League</title>
    <link href="/theme/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="./../js/selector.js"></script>
    <script type="text/javascript">
    function goBackToSchedule(date) {
        window.location = "/schedule.php";
    }

    var events = new Array();

    function fireEvents() {
        for (var i in events) {
            goBackToSchedule(events[i]);
        }
    }    
    </script>
</head>
<body onload="fireEvents()">

<div class="content">
<?php
    if (isset($_POST["oldDate"]) && isset($_POST["newDate"]) && isset($_POST["notes"]) && isset($_POST["alreadyExists"])) {
    	$oldDate = $_POST["oldDate"];
    	$newDate = $_POST["newDate"];
    	$updateDate = false;
    	if ($oldDate != $newDate) {
    		$updateDate = true;
    	}
        ScheduleDAO::setNotesForDate($oldDate, $_POST["notes"], $_POST["alreadyExists"] == "true");
        if ($updateDate) {
        	ScheduleDAO::moveScheduledDate($oldDate, $newDate);
        }
?>
        <script type="text/javascript">
            events.push('<?=$newDate?>');
        </script>
<?php
    } else {
        $notes = ScheduleDAO::getNotesForDate($_GET["date"]);
        $alreadyExists = "true";
        if (null == $notes) {
            $notes = new ScheduleDate();
            $notes->date = $_GET["date"];
            $alreadyExists = "false";
        }
?>
            <fieldset class="scheduleNotes">
                <form action="updateScheduleNotes.php" method="post" name="scheduleNotes" id="scheduleNotes" title="Schedule Notes Form">
                <p>
                    <label for="date" class="scheduleDate">Date:</label>
                    <span class="textbox">
                        <input type="hidden" name="alreadyExists" id="alreadyExists" value="<?=$alreadyExists?>"/>
                        <input type="hidden" id="oldDate" name="oldDate" value="<?=$notes->date?>"/>
                        <input name="newDate" id="newDate" type="text" size="20" value="<?=$notes->date?>"/>
                    </span>
                </p>
                <p>
                    <label for="notes" class="scheduleNotes">Notes:</label>
                    <span class="textbox">
                        <textarea rows="4" cols="40" name="notes" id="notes"><?=$notes->notes?></textarea>
                    </span>
                </p>
                
                <div id="alignRight">
                    <label for="submit">
                        <input name="publish" type="submit" value="Publish"/>
                    </label>
                </div>
                </form>
            </fieldset>
<?php
    }
?>

<form name="updateScheduleForm" method="POST">
    <input type="hidden" name="matchDate" value=""/>
</form>
</div>

<?php
    include("./../utilities.inc.php"); 
?>

<?php 
include("./../footer.inc.php");
?>