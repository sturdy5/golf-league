<?php
include('requires.inc.php');
include('./../navigation.inc.php');
?>
<html>
<head>
<title>Thursday Night Golf League</title>
<link href="/theme/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="./../js/selector.js"></script>
</head>
<body>
    <div class="content">
<?php 
        if (isset($_POST["date"]) && isset($_POST["player"]) && isset($_POST["sub"])) {
            // need to check to see if the date has been taken
            $taken = ScheduleDAO::assignSubByDate($_POST["date"], $_POST["player"], $_POST["sub"]);
            if ($taken) {
?>
                <h1>Spot already taken</h1>
<?php
            } else {
?>
                <h1>You have the spot!</h1>
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
                                    <option value="<?=$sub->id?>"><?=$sub->lastName?>, <?=$sub-firstName?></option>
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

        }
?>
    </div>
<?php
include("./../utilities.inc.php");
?>

<?php
include("./../footer.inc.php");
?>