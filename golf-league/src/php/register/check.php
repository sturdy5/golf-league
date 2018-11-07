<?php
require_once("../config.inc.php");
require_once("../dao/DBUtils.php");

function checkUsername($username) {
	global $error;
	if (!strlen($username)) {
		$error = "You must enter a username";
		return false;
	} else if (ereg("[^a-zA-Z0-9]", $username)) {
		$error = "Your username contains invalid characters";
		return false;
	} else {
		$query = "select id from users where user = '{$username}'";
		$db = DBUtils::getInstance();
		$result = $db->query($query) or die ($db->getError());
		if ($db->getRowCount($result)) {
			$error = "Your username is taken, please choose another";
			return false;
		} else {
			return true;
		}
	}
}

function checkPassword($pass1, $pass2) {
	global $error;
	if (!strlen($pass1)) {
		$error = "You must enter a password";
		return false;
	} elseif ($pass1 != $pass2) {
		$error = "Your passwords do not match";
		return false;
	} else {
		return true;
	}
}

function checkEmail($email) {
	global $error;
	if( !eregi("^[a-z0-9]+([_\\.-][a-z0-9]+)*"."@([a-z0-9]+([\.-][a-z0-9]+))*$",$email) ) {
		$error = "You entered an invalid email address";
		return false;
	} else {
		return true;
	}
}

function currentSiteURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	$pageURL = substr($pageURL, 0, strlen("check.php"));
	return $pageURL;
}

if (checkUsername($_POST['name']) && checkPassword($_POST["pass1"], $_POST["pass2"]) && checkEmail($_POST["email"])) {
	// save the user
	$query = "insert into users (user, email, password) values ('{$_POST["name"]}', '{$_POST["email"]}', '".md5($_POST["pass1"])."');";
	$db = DBUtils::getInstance();
	$result = $db->query($query) or die("Error saving the user to the database");

	// create an activation record
	$hash = md5(time() + microtime());
	$query = "insert into activation (userid, code, record) values (LAST_INSERT_ID(), '{$hash}', now());";
	$result = $db->query($query) or die ("Error writing the activation record tot he database");

	// send an email giving the activation code
	$emailText = "Thank you for signing up for the Thursday Night Golf League. You can activate your account by clicking on the link below. \n";
	$emailText .= currentSiteURL() . "activate.php?code=".urlencode($hash);
	if (mail($_POST["email"], "Thursday Night Golf League Registration", $emailText)) {
		header("location: finish.php");
		die();
	} else {
		die("There was an error sending the confirmation. Please notify the website administrator or check your registration");
	}
} else {
	$location = "index.php?name=".urlencode($_POST["name"])."&email=".urlencode($_POST["email"])."&error=".urlencode($error);
	header("location: $location");
}

?>

<html>
<head>
    <title>Checking Registration</title>
    <link href="../theme/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <p>Please wait while we register you...</p>
</body>
</html>