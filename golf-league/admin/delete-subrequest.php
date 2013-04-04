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
<?php 
        if (isset($_GET["date"]) && isset($_GET["player"])) {
            ScheduleDAO::removeSubByDate($_GET["date"], $_GET["player"]);
?>
            <fieldset class="editPlayerFields">
                <h1>Sub request has been deleted</h1>
                <p>Click <a href="/member/subs.php">here</a> to go back to the subs list</p>
            </fieldset>
<?php
        }
?>
    </div>
<?php
include("./../utilities.inc.php"); 
?>
<?php 
include("./../footer.inc.php");
?>