<?php
include('requires.inc.php');
include('./../navigation.inc.php');
?>
<html>
<head>
<title>Thursday Night Golf League</title>
<link href="/theme/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="./../js/selector.js"></script>
<script>
function goToPage(url, delay) {
	setTimeout("window.location=\"" + url + "\"", delay);
}
</script>
</head>
<body>
    <div class="content">
<?php 
        if (isset($_POST["date"]) && isset($_POST["player"]) && isset($_POST["sub"])) {
            // need to check to see if the date has been taken
            $success = ScheduleDAO::assignSubByDate($_POST["date"], $_POST["player"], $_POST["sub"]);
            if ($success) {
?>
                <fieldset class="editPlayerFields">
                    <h1>You have the spot!</h1>
                </fieldset>
                <script>
                    goToPage("subs.php", 2000);
                </script>
<?php
            } else {
?>
                <fieldset class="editPlayerFields">
                    <h1>Spot already taken</h1>
                    <p>Click <a href="subs.php">here</a> to check other spots that may be available</p>
                </fieldset>
<?php
            }
        } else if (isset($_GET["date"]) && isset($_GET["player"])) {
            $subs = PlayerDAO::getSubs();
?>
            <form name="subForm" id="subForm" method="POST" action="subs.php">
                <fieldset class="editPlayerFields">
                    <p>
                        <label for="sub" class="playerTitle">Your Name:</label>
                        <span class="textbox">
                            <select name="sub" id="sub">
<?php 
                                foreach ($subs as $sub) {
?>
                                    <option value="<?=$sub->id?>"><?=$sub->lastName?>, <?=$sub->firstName?></option>
<?php
                                }
?>
                            </select>
                            <input type="hidden" name="date" id="date" value="<?=$_GET["date"]?>"/>
                            <input type="hidden" name="player" id="player" value="<?=$_GET["player"]?>"/>
                        </span>
                    </p>
				    <div id="alignRight">
				    	<label for="submit">
				    	    <input name="submitRequestButton" type="submit" value="Submit Request"/>
				    	</label>
				    </div>
                </fieldset>
            </form>
<?php
        } else {
?>
            <fieldset class="editPlayerFields">
                <p>
                    <a href="requestSubstitute.php">Request a Sub</a>
                </p>
<?php
            $subsList = ScheduleDAO::getFutureAvailableDateSubs();
            if (count($subsList) > 0) {
?>
                <p>
                    <span class="title">The following are requested sub spots that have not been taken</span>
                </p>
                <ul>
<?php 
                    foreach ($subsList as $subEntry) {
                        $entryPlayerId = $subEntry["player"];
                        $entryDate = $subEntry["date"];
                        $entryPlayer = PlayerDAO::getPlayer($entryPlayerId);
?>
                        <li><a href="subs.php?date=<?=$entryDate?>&player=<?=$entryPlayerId?>"><?=$entryDate?> - <?=$entryPlayer->firstName?> <?=$entryPlayer->lastName?></a></li>
<?php
                    }
?>
                </ul>
                <hr/>
<?php
            } else {
?>
                <p>There are no current requests for subs</p>
                <hr/>
<?php
            }
            $takenList = ScheduleDAO::getFutureTakenDateSubs();
            if (count($takenList) > 0) {
?>
                <p>
                    <span class="title">These are the taken sub spots</span>
                </p>
                <ul>
<?php 
                    foreach ($takenList as $subEntry) {
                        $entryPlayerId = $subEntry["player"];
                        $entryDate = $subEntry["date"];
                        $entrySubId = $subEntry["sub"];
                        $entryPlayer = PlayerDAO::getPlayer($entryPlayerId);
                        $entrySub = PlayerDAO::getPlayer($entrySubId);
?>
                        <li><?=$entryDate?> - <?=$entrySub->firstName?> <?=$entrySub->lastName?> will be playing for <?=$entryPlayer->firstName?> <?=$entryPlayer->lastName?></li>
<?php
                    }
?>
                </ul>
<?php
            }
?>
            </fieldset>
<?php
        }
?>
    </div>
<?php
include("./../utilities.inc.php");
?>

<?php
include("./../footer.inc.php");
?>