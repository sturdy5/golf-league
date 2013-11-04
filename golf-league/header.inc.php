<?php
require_once('./config.inc.php');
?>

<html>
<head>
    <title><?=$config["General"]["siteTitle"]["value"]?></title>
    <link href="theme/style.css" rel="stylesheet" type="text/css"/>
    <link href="http://ajax.googleapis.com/ajax/libs/dojo/1.8.3/dijit/themes/claro/claro.css" rel="stylesheet" type="text/css"/>
</head>
<body id="body">
<?php
include_once("./analyticstracking.php");
?>
    <div class="wrap" id="wrap">
        <a href="#menu" id="menuLink" class="menu-link">Menu</a>
        <header role="banner">
            <h1><?=$config["General"]["siteTitle"]["value"]?></h1>
        </header>