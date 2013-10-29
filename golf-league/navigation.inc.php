<?php
$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);
$thisPage = $parts[count($parts) - 1];
?>

    <nav id="menu" role="navigation">
        <ul>
            <li>
                <a href="/index.php">Home</a>
            </li>
            <li>
                <a href="/temp-schedule.php">Schedule</a>
            </li>
            <li>
                <a href="/rules.html">Rules</a>
            </li>
            <li>
                <a href="/member/subs.php">Subs</a>
            </li>
            <?php
                if ($_SESSION["admin"] == 1) {
            ?>
                    <li>
                        <a href="/admin/index.php">Admin Functions</a>
                    </li>
            <?php 
                }
            ?>
        </ul>
    </nav>