<?php    
    //Set content-type header
    header("Content-type: image/png");

    //Include phpMyGraph5.0.php
    include_once('../utils/phpMyGraph5.0.php');
    include("requires.inc.php");
    
    //Set config directives
    $cfg['width'] = 500;
    $cfg['height'] = 250;
    $cfg['round-value-range'] = true;
    $cfg['average-line-visible'] = false;
    
    $playerId = $_SESSION['userid'];
    
    $handicapHistory = PlayerDAO::getHandicapHistory($playerId);
    $handicapHistory = array_reverse($handicapHistory);
    $count = count($handicapHistory);
    $firstDate = ArrayUtils::getAssociativeArrayKeyByNumber($handicapHistory, 0);
    $lastDate = ArrayUtils::getAssociativeArrayKeyByNumber($handicapHistory, $count - 1);
    
    $dateArray = ArrayUtils::createDateRangeArray($firstDate, $lastDate);
    $handicapDateArray = array_keys($handicapHistory);
    
    $dataArray = array();
    
    $previousDate = null;
    foreach ($handicapDateArray as $handicapDate) {
    	foreach ($dateArray as $date) {
    		if ($date <= $handicapDate) {
    			if (null == $previousDate || $date > $previousDate) {
    			    $dataArray[$date] = $handicapHistory[$handicapDate];
    			}
    		} else {
    			$previousDate = $handicapDate;
    			break;
    		}
    	}
    }
    
    //Create phpMyGraph instance
    $graph = new phpMyGraph();

    //Parse
    $graph->parseVerticalLineGraph($dataArray, $cfg);
?>