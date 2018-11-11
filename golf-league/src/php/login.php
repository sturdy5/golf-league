<?php
include("./requires.inc.php");
include("./config/loadConfiguration.php");

$error = "";

if (array_key_exists("username", $_POST) && array_key_exists("pass", $_POST)) {
	$query = "select id from users where user = '{$_POST["username"]}' and active=1 and password = '".MD5($_POST["pass"])."'";
	$db = DBUtils::getInstance();
	$result = $db->query($query) or die("Login query error");
	if (!$db->getRowCount($result)) {
		$error = "The username or password you entered is invalid. Be sure the account is activated";
	} else {
		$row = $db->getRow($result);
		$query = "select * from users where id=".$row["id"];
		$result = $db->query($query) or die ("User information query error");
		while ($row = $db->getRow($result)) {
			$_SESSION["team"] = $row["team"];
			$_SESSION["userid"] = $row["id"];
			$_SESSION["firstName"] = $row["firstName"];
			$_SESSION["username"] = $row["user"];
			$_SESSION["admin"] = $row["admin"];
		}
		header("location: index.php");
		die();
	}
}

if (array_key_exists("logout", $_GET) && $_GET["logout"] && $_GET["logout"] = 1) {
	session_unset();
	$_SESSION = array();
	if (session_destroy()) {
		setcookie("bcbssc_golf_league", "", "0");
		header("location: index.php");
		die();
	} else {
		die("There was an error attempting to destroy the session");
	}
}

?>

<?php
function showLogin($error) {
	echo '<html>
	<head>
	    <title>' . getConfigValue("General", "siteTitle") . '</title>
	    <link href="theme/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>';
	
	echo $error;
	echo '<form method="post" action="login.php">';
	echo '    <table class="login">';
	echo '        <tr><td>Username: </td><td><input type="text" name="username" maxlength="50"/></td></tr>';
	echo '        <tr><td>Password: </td><td><input type="password" name="pass" maxlength="50"/></td></tr>';
	echo '        <tr><!-- td colspan="2">No login? Click <a href="./register/">here</a> to register.</td --><td rowspan="3" align="center" valign="middle"><input type="submit" value="Login"/></td></tr>';
	echo '    </table>';
	echo '</form>';
} 

if (isset($_SESSION['userid'])) {
	echo '<p>You are already logged in. Click <a href="login.php?logout=1">here</a> to log out</p>';
} else {
	showLogin($error);
}

?>