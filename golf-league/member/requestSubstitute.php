<?php
include('requires.inc.php');
include('./../navigation.inc.php');
?>
<html>
<head>
<title>Thursday Night Golf League</title>
<link href="/theme/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./../js/selector.js"></script>
</head>
<body>
    <div class="content">
<?php
        if (isset($_POST["fullTimePlayer"]) && isset($_POST["date"])) {
            ScheduleDAO::assignSubByDate($_POST["date"], $_POST["fullTimePlayer"]);
            // get the full time player information
            $player = PlayerDAO::getPlayer($_POST["fullTimePlayer"]);
            // send an email with a link
            $pageURL = 'http';
            if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
            $pageURL .= "://";
            if ($_SERVER["SERVER_PORT"] != "80") {
            	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
            } else {
            	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
            }
            $pageURL = substr($pageURL, 0, strlen("requestSubstitute.php"));
            $pageURL .= "subs.php?date=" . $_POST["date"] . "&player=" . $player->id;
            
            $emailText = $player->firstName . " " . $player->lastName . " needs a sub for " . $_POST["date"] . ". Click on the link below to take the spot.\n\n";
            $emailText .= $pageURL;
            mail("jonathon.sturdevant@gmail.com", "Thursday Night Golf League Substitutes", $emailText);
?>
            <h1>Your request has been submitted</h1>
<?php
        } else {
            $fullTimePlayers = PlayerDAO::getFulltimePlayers();
            $dates = ScheduleDAO::getScheduledDates();
?>
            <form name="subForm" id="subForm" method="POST" action="requestSubstitute.php">
                <fieldset class="editPlayerFields">
			    	<p>
				    	<label for="fullTimePlayer" class="playerTitle">Your Name:</label>
					    <span class="textbox">
					        <select name="fullTimePlayer" id="fullTimePlayer">
<?php 
                                foreach ($fullTimePlayers as $player) {
?>
                                    <option value="<?=$player->id?>"><?=$player->lastName?>, <?=$player->firstName?></option>
<?php
                                }
?>
    					    </select>
					    
	    				</span>
		    		</p>
			    	<p>
				    	<label for="date" class="playerTitle">Your Name:</label>
					    <span class="textbox">
					        <select name="date" id="date">
<?php 
                                $now = new DateTime();
                                foreach ($dates as $scheduledDates) {
                                    $date1 = new DateTime($scheduledDates->date);
                                    if ($date1 >= $now) {
?>
                                        <option value="<?=$scheduledDates->date?>"><?=$scheduledDates->date?></option>
<?php
                                    }
                                }
?>
					        </select>
					    
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
        }
?>
    </div>
<?php
include("./../utilities.inc.php");
?>

<?php
include("./../footer.inc.php");
?>