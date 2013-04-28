<?php
include('requires.inc.php');
include('./../navigation.inc.php');
?>
<html>
<head>
<title>Bogey Club - Thursday Night Golf League</title>
<link href="/theme/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="./../js/selector.js"></script>
<script>
function goToPage(url, delay) {
	setTimeout("window.location=\"" + url + "\"", delay);
}

function confirmDelete() {
	return confirm("Are you sure you want to delete this request?");
}

function confirmDelete() {
	return confirm("Are you sure you want to delete this request?");
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
                                <option value="-1">-- Please Select Your Name --</option>
<?php 
                                foreach ($subs as $sub) {
?>
                                    <option value="<?=$sub->id?>"><?=$sub->lastName?>, <?=$sub->firstName?></option>
<?php
                                }
?>
                            </select>
                            <span id="subError" class="error">Please select your name from the list</span>
                            <input type="hidden" name="date" id="date" value="<?=$_GET["date"]?>"/>
                            <input type="hidden" name="player" id="player" value="<?=$_GET["player"]?>"/>
                        </span>
                    </p>
				    <div id="alignRight">
				    	<label for="submit">
				    	    <input name="submitRequestButton" type="button" onclick="validateAndSubmit()" value="Submit Request"/>
				    	</label>
				    </div>
                </fieldset>
            </form>
            <script>
                dojoConfig = {parseOnLoad: true}
            </script>
            <script src="http://ajax.googleapis.com/ajax/libs/dojo/1.8.3/dojo/dojo.js"></script>
            <script>
                function validateAndSubmit() {
                    // make sure that a player was actually selected
                    var playerId = dojo.byId("sub");
                    if (playerId.value == "-1") {
                        dojo.byId("subError").style.display = "inline";
                    } else {
                        dojo.byId("subForm").submit();
                    }
                }
            </script>
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
                        <li>
                            <a href="subs.php?date=<?=$entryDate?>&player=<?=$entryPlayerId?>"><?=$entryDate?> - <?=$entryPlayer->firstName?> <?=$entryPlayer->lastName?></a>
<?php
                            if ($_SESSION["admin"] == 1) {
?>
                                - <a onclick="return confirmDelete()" href="/admin/delete-subrequest.php?date=<?=$entryDate?>&player=<?=$entryPlayerId?>">Delete</a>
<?php
                            }
?>
                        </li>
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
                        <li>
                            <?=$entryDate?> - <?=$entrySub->firstName?> <?=$entrySub->lastName?> will be playing for <?=$entryPlayer->firstName?> <?=$entryPlayer->lastName?>
<?php
                            if ($_SESSION["admin"] == 1) {
?>
                                - <a onclick="return confirmDelete()" href="/admin/delete-subrequest.php?date=<?=$entryDate?>&player=<?=$entryPlayerId?>">Delete</a>
<?php
                            }
?>
                        </li>
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
