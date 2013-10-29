<?php
require_once('./config.inc.php');
?>

<html>
<head>
    <title><?=$config["General"]["siteTitle"]["value"]?></title>
    <link href="theme/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="./js/selector.js"></script>
    <script type="text/javascript" src="./js/menu.js"></script>
<?php 
    include_once("./utils/dojo.inc.php");
?>
</head>
<body>
<?php
include_once("./analyticstracking.php");
?>
    <div class="wrap" id="wrap">
        <a href="#menu" id="menuLink" class="menu-link">Menu</a>
        <header role="banner">
            <h1><?=$config["General"]["siteTitle"]["value"]?></h1>
        </header>