<?php 
include_once 'requires.inc.php';
include_once './../config/loadConfiguration.php';

if (isset($_GET["operation"])) {
	// the operation will map to one of the following values:
	//   - get 
	//       - category - the category of the value to get
	//       - name - the name of the value to get
	$dao = new ConfigDAO();
	$operation = $_GET["operation"];
	switch ($operation){
	    case "get":
	    	// get the value in the name field
	    	$name = $_GET["name"];
	    	$category = $_GET["category"];
	    	$value = getConfigValue($category, $name);
	    	echo $value;
	    	break;
	    default:
	    	echo "Unsupported operation - " . $operation;
	    	break;
	}
}
?>