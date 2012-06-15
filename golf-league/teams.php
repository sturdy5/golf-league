<?php
include('./header.inc.php');
require_once("./dao/PlayerDAO.php");
require_once("./dao/TeamDAO.php");
require_once("./model/Team.php");
require_once("./model/Player.php");
require_once("./utils/ArrayUtils.php");
?>

<?php 
include('./navigation.inc.php');
?>

    <div class="content">
    	<div class="teams">
    	    The teams for the first session of the 2012 season have been announced!<br/><br/>
<?php 
            $teams = TeamDAO::getAllTeams();
            if (count($teams) > 0) {
?>
    	    <table class="teams">
    	        <tr>
    	            <th>Team</th>
    	            <th colspan="2">Players</th>
    	        </tr>
<?php
                foreach ($teams as $team) { 
?>
                <tr>
                    <td><?=$team->name?></td>
<?php
                    foreach ($team->players as $player) { 
?>
                    <td><?=$player->lastName?>, <?=$player->firstName?></td>
<?php
                    } 
?>
                </tr>
<?php
                } 
?>
    	    </table>
<?php
            } else { 
?>
            <div class="no-teams">There are no teams defined.</div>
<?php
            } 
?>
    	</div>
</div>
<?php
include('./utilities.inc.php'); 
?>
<?php
include('./footer.inc.php');
?>