<?php
include('./header.inc.php');
require_once("./dao/PlayerDAO.php");
require_once("./dao/ScheduleDAO.php");
require_once("./dao/TeamDAO.php");
require_once("./model/Team.php");
require_once("./model/Player.php");
require_once("./utils/ArrayUtils.php");
include('./validate-admin.php');
?>

<?php 
include('./navigation.inc.php');

$playerDao = new PlayerDAO();
$availablePlayers = $playerDao->getFulltimePlayersWithoutTeams();
$playerCount = count($availablePlayers);
?>

<script type="text/javascript">
    function createTeam() {
        var playerList = document.getElementById("teamPlayers");
        var playerIds = getSelectorIds(playerList);
        document.getElementById("playerIds").value=playerIds;
        document.forms.teamForm.submit();
    }
</script>
<div class="content">
	<form action="createteam.php" method="post" name="teamForm" id="teamForm" title="Team Creation Form" dir="ltr" lang="en">
		<fieldset class="addPostFields">
			<p>
				<label for="teamName" class="teamTitle">Team Name:</label> 
				<span class="textbox">
				    <input name="teamName" type="text" size="78" maxlength="80" />
				</span>
			</p>
			<p>
				<label for="players" class="teamTitle">Team Players:</label>
				<span class="textbox">
				    <table class="playerSelector">
				        <tr>
				            <th>Available Players</th>
				            <th></th>
				            <th>Players on the Team</th>
				        </tr>
				        <tr>
				            <td>
				                <select id="available" multiple="multiple" size="<?=$playerCount?>">
<?php
                                    foreach($availablePlayers as $player) {
?>
                                    <option value="<?=$player->id?>"><?=$player->lastName?>, <?=$player->firstName?></option>
<?php
                                    } 
?>
				                </select>
				            </td>
				            <td>
				                <input type="button" value="--&gt;" onclick="moveOptions(document.getElementById('available'), document.getElementById('teamPlayers'));"/><br/>
				                <input type="button" value="&lt;--" onclick="moveOptions(document.getElementById('teamPlayers'), document.getElementById('available'));"/><br/>
				            </td>
				            <td>
				                <select id="teamPlayers" multiple="multiple" size="<?=$playerCount?>">
				                </select>
				            </td>
				        </tr>
				    </table>
				    <input type="hidden" name="playerIds" id="playerIds" value=""/>
				</span>
			</p>
			
			<div id="alignRight">
				<label for="submit">
				    <input name="createTeamButton" type="button" value="Create Team" onclick="createTeam()" />
				</label>
			</div>
		</fieldset>
	</form>
</div>

<?php
include("./utilities.inc.php"); 
?>

<?php
include('./footer.inc.php');
?>