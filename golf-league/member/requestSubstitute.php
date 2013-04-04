<?php
include('requires.inc.php');
include('./../navigation.inc.php');
?>
<html>
<head>
<title>Thursday Night Golf League</title>
<link href="/theme/style.css" rel="stylesheet" type="text/css" />
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
        if (isset($_POST["fullTimePlayer"]) && isset($_POST["date"])) {
            ScheduleDAO::assignSubByDate($_POST["date"], $_POST["fullTimePlayer"]);
            // get the full time player information
            $player = PlayerDAO::getPlayer($_POST["fullTimePlayer"]);
            // send an email with a link
            $pageURL = "http://www.bctngl.com/member/subs.php?date=" . $_POST["date"] . "&player=" . $player->id;
            
            $emailText = $player->firstName . " " . $player->lastName . " needs a sub for " . $_POST["date"] . ". Click on the link below to take the spot.\n\n";
            $emailText .= $pageURL;
            
            $subEmails = PlayerDAO::getSubEmails();
            $toAddresses = implode(", ", $subEmails);
            
            $headers = "From: info@bctngl.com" . "\r\n" . "Reply-To: info@bctngl.com";
            mail($toAddresses, "Thursday Night Golf League Substitutes", $emailText, $headers);
?>
            <fieldset class="editPlayerFields">
                <h1>Your request has been submitted</h1>
            </fieldset>
            <script>
                goToPage("subs.php", 2000);
            </script>
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
					            <option value="-1">-- Please Select Your Name --</option>
<?php 
                                foreach ($fullTimePlayers as $player) {
?>
                                    <option value="<?=$player->id?>"><?=$player->lastName?>, <?=$player->firstName?></option>
<?php
                                }
?>
    					    </select>
					        <span id="fullTimePlayerError" class="error">Please select your name from the list</span>
	    				</span>
		    		</p>
			    	<p>
				    	<label for="date" class="playerTitle">Date:</label>
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
                    var playerId = dojo.byId("fullTimePlayer");
                    if (playerId.value == "-1") {
                        dojo.byId("fullTimePlayerError").style.display = "inline";
                    } else {
                        dojo.byId("subForm").submit();
                    }
                }
            </script>
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