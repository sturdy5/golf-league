<?php
include("./requires.inc.php");
include("./config/loadConfiguration.php");
include('./header.inc.php');
include('./validate-admin.php');
?>

<?php 
include('./navigation.inc.php');
?>

<div class="content">
    <div class="teams">
    <div class="team-actions">
        <span class="team-action"><a href="admin-createTeam.php">Create a new team</a></span>
    </div>
<?php 
    $teams = TeamDAO::getAllTeams();
    if (count($teams) > 0) {
?>
    
    <table class="teams">
        <tr>
            <th>Name</th>
            <th>Players</th>
            <th colspan="2">Actions</th>
        </tr>
<?php
        foreach ($teams as $team) {
?>
        <tr>
            <td><?=$team->name?></td>
            <td>
<?php
                $players = $team->players;
                if (count($players) > 0) {
?>
                <ul>
<?php
                    foreach ($players as $player) {
?>
                    <li><?=$player->firstName?> <?=$player->lastName?></li>
<?php
                    } 
?>
                </ul>
<?php
                } else {
?>
                None
<?php
                } 
?>
            </td>
            <td class="noborder">
                <a href="admin-editTeam.php?id=<?=$team->id?>">Edit</a>
            </td>
            <td class="noborder">
                <a href="admin-deleteTeam.php?id=<?=$team->id?>">Delete</a>
            </td>
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