<?php
include("requires.inc.php");
include('./../validate-admin.php');
    if (isset($_GET["id"])) {
        PlayerDAO::removeAdmin($_GET["id"]);
    }
    header("location: ../admin-players.php");
?>