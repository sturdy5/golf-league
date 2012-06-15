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
include('./../validate-member.php');
include('./../navigation.inc.php');
?>
<html>
<head>
<title>Thursday Night Golf League</title>
<link href="/theme/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./../js/selector.js"></script>
<script type="text/javascript">
function goBackToHome() {
    window.location = "/index.php";
}

var events = new Array();

function fireEvents() {
    for (var i in events) {
        goBackToHome();
        break;
    }
}

function editPlayer() {
	var submitForm = true;

	var errorMessages = "Please note the following:\n";

	// verify if the password change was selected that the new passwords match
	var newPasswordCheckbox = document.getElementById("newPasswordCheckbox");
	if (newPasswordCheckbox && newPasswordCheckbox.checked) {
        var newPassword1 = document.getElementById("newPassword1").value;
        var newPassword2 = document.getElementById("newPassword2").value;
        if (newPassword1 != newPassword2) {
            errorMessages += "- Passwords do not match\n";
            submitForm = false;
        }
	}
	if (submitForm == true) {
        document.forms.playerForm.submit();
	} else {
		alert(errorMessages);
	}
}

function hideOrShowNewPasswordFields() {
	var newPasswordCheckbox = document.getElementById("newPasswordCheckbox");
    if (newPasswordCheckbox && newPasswordCheckbox.checked) {
        // show the fields
        document.getElementById("changePasswordFields").style.display = "block";
    } else {
        // hide the fields
        document.getElementById("changePasswordFields").style.display = "none";
    }
}
</script>
</head>
<body onload="fireEvents()">

	<div class="content">
<?php
		if (isset($_POST["id"]) && isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"]) && isset($_POST["phoneNumber"]) && isset($_POST["newPassword1"])) {
		    $player = new Player();
		    $player->id = $_POST["id"];
		    $player->firstName = $_POST["firstName"];
		    $player->lastName = $_POST["lastName"];
		    $player->emailAddress = $_POST["email"];
		    $player->phoneNumber = $_POST["phoneNumber"];
		    
		    PlayerDAO::editAccount($player);
		    
		    $newPassword = $_POST["newPassword1"];
		    if ($newPassword != "") {
		        PlayerDAO::changePassword($player->id, $newPassword);
		    }
?>
		<script type="text/javascript">
	        events.push('back');
	    </script>
<?php
		} else {
		    $player = PlayerDAO::getPlayer($_SESSION['userid']);
		    if (null == $player) {
?>
		<script type="text/javascript">
	        events.push('back');
	    </script>
<?php
		    } else {
?>
		<form name="playerForm" id="playerForm" method="POST" action="myAccount.php">
			<fieldset class="editPlayerFields">
				<p>
					<label for="firstName" class="playerTitle">First Name:</label> <span
						class="textbox"> <input name="id" type="hidden"
						value="<?=$player->id?>" /> <input name="firstName" type="text"
						size="78" maxlength="50" value="<?=$player->firstName?>" />
					</span>
				</p>
				<p>
					<label for="lastName" class="playerTitle">Last Name:</label> <span
						class="textbox"> <input name="lastName" type="text" size="78"
						maxlength="50" value="<?=$player->lastName?>" />
					</span>
				</p>
				<p>
					<label for="email" class="playerTitle">Email Address:</label> <span
						class="textbox"> <input name="email" type="text" size="78"
						maxlength="50" value="<?=$player->emailAddress?>" />
					</span>
				</p>
				<p>
					<label for="phoneNumber" class="playerTitle">Phone Number:</label>
					<span class="textbox"> <input name="phoneNumber" type="text"
						size="78" maxlength="20" value="<?=$player->phoneNumber?>" />
					</span>
				</p>
				<p>
				    <label for="changePasswordCheckbox" class="playerTitle">Change Password?</label>
				    <span class="textbox"><input type="checkbox" name="newPasswordCheckbox" id="newPasswordCheckbox" onchange="hideOrShowNewPasswordFields()"/></span>
				    <div style="display: none;" id="changePasswordFields">
				        <p>
				            <label for="newPassword1" class="playerTitle">New Password:</label>
				            <span class="textbox"><input type="password" name="newPassword1" id="newPassword1"/></span>
				        </p>
				        <p>
				            <label for="newPassword2" class="playerTitle">Verify Password:</label>
				            <span class="textbox"><input type="password" name="newPassword2" id="newPassword2"/></span>
				        </p>
				    </div>
				</p>
				<div id="alignRight">
					<label for="submit"> <input name="updatePlayerButton" type="button"
						value="Update" onclick="editPlayer()" />
					</label>
				</div>
			</fieldset>
		</form>
		<p/>
		<table class="statistics">
		    <tr>
		        <th>Handicap History</th>
		    </tr>
		    <tr>
		        <td>
		            <iframe src="handicap-history.php" width="500" height="250"></iframe>
		        </td>
		    </tr>
		</table>
		
		<?php
            }
        }
?>
	</div>

	<?php
include("./../utilities.inc.php");
?>

	<?php
include("./../footer.inc.php");
?>