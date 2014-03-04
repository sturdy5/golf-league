<?php
include("./requires.inc.php");
include('./../validate-admin.php');
    if (isset($_GET["id"])) {
        PlayerDAO::removePlayer($_GET["id"]);
    }
    header("location: ../admin-players.php");
?>