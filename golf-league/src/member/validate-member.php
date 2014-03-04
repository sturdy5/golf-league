<?php
if (!isset($_SESSION['userid'])) {
    header("location: /notamember.php");
}
?>