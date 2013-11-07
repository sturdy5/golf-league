<?php
include("./requires.inc.php");
include('./../config/loadConfiguration.php');
include('./../validate-admin.php');
include('./../navigation.inc.php');
?>
<html>
<head>
    <title><?=$config["General"]["siteTitle"]["value"]?></title>
    <link href="/theme/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="./../js/selector.js"></script>
    <script type="text/javascript">
    function goBackToPlayerList() {
        window.location = "/admin-players.php";
    }

    var events = new Array();

    function fireEvents() {
        for (var i in events) {
        	goBackToPlayerList();
        	break;
        }
    }

    function editPlayer() {
        var fullTimeValue = document.getElementById("fullTimeCheckbox").checked;
        if (fullTimeValue == true) {
            document.getElementById("fullTime").value = "1";
        } else {
            document.getElementById("fullTime").value = "0";
        }
        // active
        var activeValue = document.getElementById("activeCheckbox").checked;
        if (activeValue == true) {
            document.getElementById("active").value = "1";
        } else {
            document.getElementById("active").value = "0";
        }
        // usercontrolled
        var usercontrolledValue = document.getElementById("usercontrolledCheckbox").checked;
        if (usercontrolledValue == true) {
            document.getElementById("usercontrolled").value = "1";
        } else {
            document.getElementById("usercontrolled").value = "0";
        }
        // admin
        var adminValue = document.getElementById("adminCheckbox").checked;
        if (adminValue == true) {
            document.getElementById("admin").value = "1";
        } else {
            document.getElementById("admin").value = "0";
        }

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
<?php  
include_once("../analyticstracking.php");
?>
<div class="content">
<?php
    $seasonId = ScheduleDAO::getCurrentSeason();
    if (isset($_POST["id"]) && isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"]) && isset($_POST["phoneNumber"]) && isset($_POST["handicap"]) && isset($_POST["fullTime"]) && isset($_POST["active"]) && isset($_POST["usercontrolled"]) && isset($_POST["admin"]) && isset($_POST["username"]) && isset($_POST["newPassword1"])) {
        $player = new Player();
        $player->id = $_POST["id"];
        $player->firstName = $_POST["firstName"];
        $player->lastName = $_POST["lastName"];
        $player->emailAddress = $_POST["email"];
        $player->phoneNumber = $_POST["phoneNumber"];
        $player->handicap = $_POST["handicap"];
        $player->fulltime = ("1" == $_POST["fullTime"]);
        $player->active = ("1" == $_POST["active"]);
        $player->usercontrolled = ("1" == $_POST["usercontrolled"]);
        $player->admin = ("1" == $_POST["admin"]);
        $player->username = $_POST["username"];
        
    	PlayerDAO::updatePlayer($player);
    	
    	$newPassword = $_POST["newPassword1"];
    	if ($newPassword != "") {
    	    PlayerDAO::changePassword($player->id, $newPassword);
    	}
    	
    	if (isset($_POST["teeBox"])) {
    		PlayerDAO::setPlayerTee($player->id, $_POST["teeBox"], $seasonId);
    	}
?>
        <script type="text/javascript">
            events.push('back');
        </script>
<?php
    } else {
        $player = PlayerDAO::getPlayer($_GET["id"]);
        $courseId = ScheduleDAO::getCourseBySeason($seasonId);
        $playerTeeId = PlayerDAO::getPlayerTee($player->id, $seasonId);
        $tees = CourseDAO::getTees($courseId);
        
        if (null == $player) {
?>
        <script type="text/javascript">
            events.push('back');
        </script>
<?php
        } else {
?>
            <form name="playerForm" id="playerForm" method="POST" action="editPlayer.php">
            <fieldset class="editPlayerFields">
    			<p>
    				<label for="firstName" class="playerTitle">First Name:</label> 
    				<span class="textbox">
    				    <input name="id" type="hidden" value="<?=$player->id?>"/>
    				    <input name="firstName" type="text" size="78" maxlength="50" value="<?=$player->firstName?>" />
    				</span>
    			</p>
    			<p>
    				<label for="lastName" class="playerTitle">Last Name:</label> 
    				<span class="textbox">
    				    <input name="lastName" type="text" size="78" maxlength="50" value="<?=$player->lastName?>"/>
    				</span>
    			</p>
    			<p>
    				<label for="email" class="playerTitle">Email Address:</label> 
    				<span class="textbox">
    				    <input name="email" type="text" size="78" maxlength="50" value="<?=$player->emailAddress?>"/>
    				</span>
    			</p>
    			<p>
    				<label for="phoneNumber" class="playerTitle">Phone Number:</label> 
    				<span class="textbox">
    				    <input name="phoneNumber" type="text" size="78" maxlength="20" value="<?=$player->phoneNumber?>"/>
    				</span>
    			</p>
    			<p>
    			    <label for="handicap" class="playerTitle">Handicap:</label>
    			    <span class="textbox">
    			        <input name="handicap" type="text" size="5" value="<?=$player->handicap?>"/>
    			    </span>
    			</p>
    		    <p>
    		        <label for="teeBox" class="playerTitle">Tee Box:</label>
    		        <span class="textbox">
    		        	<select name="teeBox" id="teeBox">
    		        	    <option value="-1">No tee box</option>
<?php 
                            foreach ($tees as $tee) {
?>
                                <option value="<?=$tee->id?>"
<?php 
                                if ($tee->id == $playerTeeId) {
?>
                                    selected="selected"
<?php 
                                }
?>
                                ><?=$tee->name?> (<?=$tee->color?>)</option>
<?php 
                            }
?>
    		        	</select>    
    		        </span>
    		    </p>
    			<p>
    				<label for="fullTime" class="playerTitle">Full Time:</label> 
    				<span class="textbox">
    				    <input name="fullTimeCheckbox" type="checkbox" id="fullTimeCheckbox" <?php if ($player->fulltime) { echo "checked='checked'"; } ?>/>
    				    <input name="fullTime" type="hidden" id="fullTime" value="<?php if ($player->fulltime) { echo "1"; } else { echo "0"; }?>"/>
    				</span>
    			</p>
    			<p>
    			    <label for="active" class="playerTitle">Active:</label>
    			    <span class="textbox">
    				    <input name="activeCheckbox" type="checkbox" id="activeCheckbox" <?php if ($player->active) { echo "checked='checked'"; } ?>/>
    				    <input name="active" type="hidden" id="active" value="<?php if ($player->active) { echo "1"; } else { echo "0"; }?>"/>
    				</span>
    		    </p>
    		    <p>
    		        <label for="username" class="playerTitle">Username:</label>
    		        <span class="textbox">
    		            <input name="username" id="username" type="text" value="<?=$player->username?>"/>
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
    			<p>
    			    <label for="active" class="playerTitle">User Controlled:</label>
    			    <span class="textbox">
    				    <input name="usercontrolledCheckbox" type="checkbox" id="usercontrolledCheckbox" <?php if ($player->usercontrolled) { echo "checked='checked'"; } ?>/>
    				    <input name="usercontrolled" type="hidden" id="usercontrolled" value="<?php if ($player->usercontrolled) { echo "1"; } else { echo "0"; }?>"/>
    				</span>
    		    </p>
    			<p>
    			    <label for="admin" class="playerTitle">Admin:</label>
    			    <span class="textbox">
    				    <input name="adminCheckbox" type="checkbox" id="adminCheckbox" <?php if ($player->admin) { echo "checked='checked'"; } ?>/>
    				    <input name="admin" type="hidden" id="admin" value="<?php if ($player->admin) { echo "1"; } else { echo "0"; }?>"/>
    				</span>
    		    </p>
    			<div id="alignRight">
    				<label for="submit">
    				    <input name="createPlayerButton" type="button" value="Save Player" onclick="editPlayer()" />
    				</label>
    			</div>
    		</fieldset>
    		</form>
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