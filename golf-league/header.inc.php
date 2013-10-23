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
    <div id="wrapper">
    <a href="" id="clear-btn"></a>
    
    <header role="banner">
        <h1><?=$config["General"]["siteTitle"]["value"]?></h1>
        <?php 
            // This menu button is displayed when the screen size is too small to show the main navigation buttons 
        ?>
        <a href="" id="menu-button" class="ir menu-mobile menu-button" role="presentation">menu</a>
    </header>