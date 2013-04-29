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
    <a href="/admin/importHandicaps.php">Click here</a> to import the handicaps from an Excel spreadsheet
<?php 
    $players = PlayerDAO::getAllPlayers();
    if (count($players) > 0) {
?>
    <form name="assignHandicap" id="assignHandicap" method="POST" action="processhandicaps.php">    
    <table class="handicaps">
        <tr>
            <th>Name</th>
            <th>Handicap</th>
        </tr>
<?php
        foreach ($players as $player) {
?>
        <tr>
            <td><?=$player->lastName?>, <?=$player->firstName?></td>
            <td><input type="text" name="player-<?=$player->id?>" id="player-<?=$player->id?>" value="<?=$player->handicap?>" size="2"/></td>
        </tr>
<?php
        }
?>
        <tr>
            <td></td>
            <td><input type="submit" name="processHandicaps" value="Process Handicaps"/></td>
        </tr>
    </table>
    </form>  
<?php
    } else {
?>
    <div class="no-players">There are no players defined.</div>
<?php
    } 
?>
</div>

<?php
include('./utilities.inc.php');
include('./footer.inc.php');
?>