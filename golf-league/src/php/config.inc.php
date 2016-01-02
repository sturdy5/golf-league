<?php

// start the session
session_name("bcbssc_golf_league");
session_start();

// database configuration
$db_server = "107.180.51.10";
$db_user = "bcbsscgl";
$db_password = "hnTCZXEN2Ab6tb";
$db_database = "bcbsscgl";
/*
 * phpMyAdmin - https://p3nlmysqladm001.secureserver.net/grid50/3447/index.php?uniqueDnsEntry=bcbsscgl.db.9045345.hostedresource.com
 * 
 * email - https://login.secureserver.net/index.php?app=wbe
 */

// setup the database
$link = mysql_connect($db_server, $db_user, $db_password) or die ("Could not connect to the database");
mysql_select_db($db_database) or die ("Could not select the database");

?>