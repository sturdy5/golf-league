<?php
// pull the configuration out of the database.
$config = $_SESSION["config"];
if (!isset($config)) {
	$config = ConfigDAO::getConfiguration();
	$_SESSION["config"];
}

function getConfigValue($category, $variable) {
	$returnVar = "";
	global $config;
	if (isset($config) && isset($config[$category]) && isset($config[$category][$variable])) {
	    $returnVar = $config[$category][$variable]["value"];
	}
	return $returnVar;
}
?>