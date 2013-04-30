<?php
include('requires.inc.php');
include('./../config/loadConfiguration.php');
include('./../validate-admin.php');
include('./../navigation.inc.php');
?>
<html>
<head>
    <title><?=getConfigValue("General", "siteTitle")?></title>
    <link href="/theme/style.css" rel="stylesheet" type="text/css"/>
    <link href="http://ajax.googleapis.com/ajax/libs/dojo/1.8.3/dijit/themes/claro/claro.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="./../js/selector.js"></script>
    <script>
        dojoConfig = {parseOnLoad: true}
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/dojo/1.8.3/dojo/dojo.js"></script>
    <script type="text/javascript">

    // pull in the dojo tools for a date text box
    require(["dojo/parser", "dijit/form/DateTextBox"]);

    function saveSettings() {
    	document.forms.settingsForm.submit();
    }
    </script>
</head>
<body class="claro">
<div class="content">
<?php
    $message = "";
    if (isset($_POST["saveConfiguration"])) {
        $configToSave = array();
        foreach($_POST as $key => $value) {
            if (substr($key, 0, 8) == "config_s") {
                $keyValues = split("_", $key);
                if (count($keyValues) == 4) {
                    $category = $keyValues[2];
                    $variable = $keyValues[3];
                    if (!isset($configToSave[$category])) {
                    	$configToSave[$category] = array();
                    }
                    $configToSave[$category][$variable] = array();
                    $configToSave[$category][$variable] = $value;
                }
            }
        }
        ConfigDAO::saveConfiguration($configToSave);
        unset($_SESSION["config"]);
        $message = "Successfully saved settings!";
    }
    $configuration = ConfigDAO::getConfiguration();
        
?>
    <div class="seasonForm">
        <?=$message?>
        <form name="settingsForm" id="settingsForm" method="POST" action="editConfiguration.php">
            <fieldset class="editSeasonFields">
<?php 
                foreach ($configuration as $categoryName => $category) {
?>
                    <p><label for="<?=$categoryName?>" class="category"><?=$categoryName?></label></p>
<?php 
                    foreach ($category as $variable => $value) {
?>
            			<p>
            				<label for="<?=$variable?>" class="fieldTitle"><?=$value["name"]?>:</label> 
        	    			<span class="textbox">
        		    		    <input type="text" name="config_s_<?=$categoryName?>_<?=$variable?>" id="config_s_<?=$categoryName?>_<?=$variable?>" value="<?=$value["value"]?>"/>
    	    		    	</span>
        		    	</p>
<?php 
                    }
                }
?>
    			<div id="alignRight">
    				<label for="submit">
    				    <input name="saveConfiguration" id="saveConfiguration" value="false" type="hidden"/>
    				    <input name="saveSettingsButton" type="button" value="Save Settings" onclick="saveSettings()" />
    				</label>
    			</div>
    		</fieldset>
        </form>
    </div>
</div>

<?php
    include("./../utilities.inc.php"); 
?>

<?php 
include("./../footer.inc.php");
?>