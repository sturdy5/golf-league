<?php 
include_once 'requires.inc.php';

if (isset($_GET["operation"])) {
	// the operation will map to one of the following values:
	//   - get 
	$operation = $_GET["operation"];
	switch ($operation){
	    case "get":
	    	$dao = new BlogDAO();
	    	$blog = $dao->getBlogInformation();
	    	echo json_encode($blog);
	    	break;
	    default:
	    	echo "Unsupported operation - " . $operation;
	    	break;
	}
}
?>