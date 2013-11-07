<?php
if (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0) {
    header("location: /notanadmin.php");
}
?>