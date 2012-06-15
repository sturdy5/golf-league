<?php
include('./header.inc.php');
require_once("./dao/PlayerDAO.php");
require_once("./dao/TeamDAO.php");
require_once("./model/Team.php");
require_once("./model/Player.php");
require_once("./utils/ArrayUtils.php");
include('./validate-admin.php');
?>

<?php 
include('./navigation.inc.php');
?>

<script type="text/javascript">
function deletePlayer(playerId, playerName) {
    var confirmed = confirm("Are you sure you wish to delete " + playerName + "?");
    if (confirmed == true) {
        window.location = "admin/deletePlayer.php?id=" + playerId;
    }
}

function makePlayerAdmin(playerId, playerName) {
	var confirmed = confirm("Are you sure you wish to make " + playerName + " an admin?");
	if (confirmed == true) {
		window.location = "admin/assignAdmin.php?id=" + playerId;
	}
}

function removeAdmin(playerId, playerName) {
	var confirmed = confirm("Are you sure you wish to remove " + playerName + " from the admin list?");
	if (confirmed == true) {
		window.location = "admin/revokeAdmin.php?id=" + playerId;
	}
}
</script>

<div class="content">
    <div class="players">
    <div class="players-action">
        <span class="player-action"><a href="admin-createPlayer.php">Add a new player</a></span>
    </div>
<?php 
    $players = PlayerDAO::getAllPlayers();
    if (count($players) > 0) {
        
?>
    
    <table class="players">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Full Time/Substitute</th>
            <th>Team Name</th>
            <th colspan="2">Actions</th>
        </tr>
<?php
        foreach ($players as $player) {
?>
        <tr>
            <td><?=$player->lastName?>, <?=$player->firstName?></td>
            <td><?=$player->emailAddress?></td>
            <td><?=$player->phoneNumber?></td>
            <td>
<?php
                if ($player->fulltime) {
                    echo "full-time";
                } else {
                    echo "sub";
                } 
?>
            </td>
            <td>
<?php
                if ($player->teamId != null) {
                    $team = TeamDAO::getTeamById($player->teamId);
                    echo $team->name;
                }
?>
            </td>
            <td class="noborder">
                <a href="admin/editPlayer.php?id=<?=$player->id?>">Edit</a>
            </td>
            <td class="noborder">
                <a href="#" onclick="deletePlayer('<?=$player->id?>', '<?=$player->firstName?> <?=$player->lastName?>');return false;">Delete</a>
            </td>
        </tr>
<?php
        }
?>
    </table>
    
<?php
    } else {
?>
    <div class="no-players">There are no players defined.</div>
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