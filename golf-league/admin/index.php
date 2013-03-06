<?php
include('requires.inc.php');
include('./../validate-admin.php');
include('./../navigation.inc.php');
?>
<html>
<head>
    <title>Thursday Night Golf League</title>
    <link href="/theme/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="./../js/selector.js"></script>
</head>
<body>
<div class="content">
    <div class="adminForm">
        <ul>
            <li><a href="/admin-players.php">Manage Players</a></li>
            <li><a href="/admin-assignHandicap.php">Assign Handicaps</a></li>
            <li><a href="/admin/createSeason.php">Create Season</a></li>
        </ul>
    </div>
</div>

<?php
    include("./../utilities.inc.php"); 
?>

<?php 
include("./../footer.inc.php");
?>