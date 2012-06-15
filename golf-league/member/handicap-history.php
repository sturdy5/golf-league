<?php    
    //Set content-type header
    header("Content-type: image/png");

    //Include phpMyGraph5.0.php
    include_once('../utils/phpMyGraph5.0.php');
    require_once('../config.inc.php');
    require_once("../dao/PlayerDAO.php");
    require_once("../dao/TeamDAO.php");
    require_once("../model/Team.php");
    require_once("../model/Player.php");
    require_once("./../utils/ArrayUtils.php");
    
    //Set config directives
    $cfg['width'] = 500;
    $cfg['height'] = 250;
    $cfg['round-value-range'] = true;
    
    $playerId = $_SESSION['userid'];
    
    $handicapHistory = PlayerDAO::getHandicapHistory($playerId);
    $handicapHistory = array_reverse($handicapHistory);
    $count = count($handicapHistory);
    $firstDate = ArrayUtils::getAssociativeArrayKeyByNumber($handicapHistory, 0);
    $lastDate = ArrayUtils::getAssociativeArrayKeyByNumber($handicapHistory, $count - 1);
    
    $data = ArrayUtils::createDateRangeArray($firstDate, $secondDate);
    
    //Create phpMyGraph instance
    $graph = new phpMyGraph();

    //Parse
    $graph->parseVerticalLineGraph(array_reverse($handicapHistory), $cfg);
?>