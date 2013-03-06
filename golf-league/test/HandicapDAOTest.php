<?php
require_once('../config.inc.php');
require_once("../dao/DBUtils.php");
require_once("../utils/ArrayUtils.php");
require_once('../dao/HandicapDAO.php');
require_once('../model/HandicapMethod.php');
require_once('../dao/CourseDAO.php');
require_once('../dao/PlayerDAO.php');
require_once('../dao/ScheduleDAO.php');
require_once('../dao/TeamDAO.php');
require_once('../dao/ScoreDAO.php');
require_once('../model/Course.php');
require_once('../model/Hole.php');
require_once('../model/Matchup.php');
require_once('../model/Tee.php');
require_once('../model/Player.php');
require_once('../model/Scores.php');
require_once('../model/Team.php');

$dao = new HandicapDAO();
$playerId = 3; // jon sturdevant
$matchId = 200; // 2012-08-23
$handicap = $dao->calculateHandicap($playerId, $matchId, HandicapMethod::USGA);

echo "Testing HandicapDAO - handicap - $handicap";

?>