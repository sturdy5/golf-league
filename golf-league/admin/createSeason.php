<?php
include('requires.inc.php');
include('./../config/loadConfiguration.php');
include('./../validate-admin.php');
include('./../navigation.inc.php');
?>
<html>
<head>
    <title><?=$config["General"]["siteTitle"]["value"]?></title>
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

    function createSeason() {
    	document.forms.seasonForm.submit();
    }
    </script>
</head>
<body class="claro">
<div class="content">
<?php
    $courses = CourseDAO::getAllCourses();
    $message = "";
    if (isset($_POST["startDate"]) && isset($_POST["endDate"]) && isset($_POST["course"]) && isset($_POST["teamStructure"]) && isset($_POST["scoreStyle"])) {
        ScheduleDAO::createSeason($_POST["startDate"], $_POST["endDate"], $_POST["course"], $_POST["teamStructure"], $_POST["scoreStyle"]);
        $message = "Successfully create season!";
    }
        
?>
    <div class="seasonForm">
        <?=$message?>
        <form name="seasonForm" id="seasonForm" method="POST" action="createSeason.php">
            <fieldset class="editSeasonFields">
    			<p>
    				<label for="startDate" class="fieldTitle">Start Date:</label> 
    				<span class="textbox">
    				    <input type="text" name="startDate" id="startDate" data-dojo-type="dijit/form/DateTextBox" required="true" />
    				</span>
    			</p>
    			<p>
    			    <label for="endDate" class="fieldTitle">End Date:</label>
    			    <span class="textbox">
    			        <input type="text" name="endDate" id="endDate" data-dojo-type="dijit/form/DateTextBox" required="true"/>
    			    </span>
    			</p>
    			<p>
    			    <label for="course" class="fieldTitle">Course:</label>
    			    <span class="textbox">
    			        <select name="course" id="course">
<?php 
                            foreach ($courses as $course) {
?>
                                <option value="<?=$course->id?>"><?=$course->name?></option>
<?php 
                            }
?>
    			        </select>
    			    </span>
    			</p>
    			<p>
    			    <label for="teamStructure" class="fieldTitle">Team Structure:</label>
    			    <span class="textbox">
    			        <select name="teamStructure" id="teamStructure">
    			            <option value="TWO_PERSON">Two Person Teams</option>
    			            <option value="INDIVIDUAL">Individual</option>
    			        </select>
    			    </span>
    			</p>
    			<p>
    			    <label for="scoreStyle" class="fieldTitle">Handicap Style:</label>
    			    <span class="textbox">
    			        <select name="scoreStyle" id="scoreStyle">
    			            <option value="STRAIGHT">Straight Average</option>
    			            <option value="USGA">USGA</option>
    			        </select>
    			    </span>
    			</p>
    			<div id="alignRight">
    				<label for="submit">
    				    <input name="createSeasonButton" type="button" value="Save Season" onclick="createSeason()" />
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