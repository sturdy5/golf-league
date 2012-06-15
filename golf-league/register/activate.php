<?php
require_once("../config.inc.php");

if (isset($_GET["code"]) && strlen($_GET["code"])) {
	echo '<html>
	      <head>
	          <title>Registration</title>
	          <link href="../theme/style.css" rel="stylesheet" type="text/css"/>
	      </head>
	      <body>';
	$lookup = urldecode($_GET["code"]);
	$query = "select userid from activation where code = '$lookup' LIMIT 1";
	$result = mysql_query($query) or die ("Error retrieving the record corresponding to the activation code");
	if (mysql_num_rows($result)) {
		$user = mysql_fetch_array($result);
		$query = "update users set active = 1 where id = ".$user["userid"];
		$result = mysql_query($query) or die ("Error activating the user");
		$query = "delete from activation where code = '$lookup' LIMIT 1";
		$result = mysql_query($query) or die ("Error removing the activation record");
		echo '<p>You are good to go, please <a href="../login.php">login</a>';
	} else {
		echo '<p>That code is invalid</p>';
	}
	echo '</body>
	      </html>';
} else {
	// don't belong here
	header("location: index.php");
}

?>