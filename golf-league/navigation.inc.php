<?php
$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);
$thisPage = $parts[count($parts) - 1];
?>

    <div class="navigation">
        <?php
        if ($thisPage != "index.php") { 
        ?>
        <a href="/index.php">
            <span class="nav-key">Home</span>
        </a>
        <?php
        }
        if ($thisPage != "teams.php") {
        ?>
        <a href="/teams.php">
            <span class="nav-key">Teams</span>
        </a>
        <?php
        }
        if ($thisPage != "standings.php") { 
        ?>
        <a href="/results-2012-03-15.html">
            <span class="nav-key">Results</span>
        </a>
        <?php
        }
        if ($thisPage != "statistics.php") { 
        ?>
        <a href="/working.html">
            <span class="nav-key">Statistics</span>
        </a>
        <?php 
        }
        if ($thisPage != "schedule.php") {
        ?>
        <a href="/schedule.php">
            <span class="nav-key">Schedule</span>
        </a>
        <?php 
        }
        if ($thisPage != "rules.php") {
        ?>
        <a href="/rules.html">
            <span class="nav-key">Rules</span>
        </a>
        <?php 
        }
        if ($_SESSION["admin"] == 1) {
        	if ($thisPage != "admin-players.php") {
        		?>
                <a href="/admin-players.php">
                    <span class="admin-nav-key">Manage Players</span>
                </a>
                <?php
        	}
        	if ($thisPage != "admin-teams.php") {
        		?>
                <a href="/admin-teams.php">
                    <span class="admin-nav-key">Manage Teams</span>
                </a>
                <?php
        	}
        	if ($thisPage != "admin-assignHandicap.php") {
        	    ?>
        	    <a href="/admin-assignHandicap.php">
        	        <span class="admin-nav-key">Assign Handicaps</span>
        	    </a>
        	    <?php
        	}
        ?>
        <?php
        } 
        ?>
    </div>