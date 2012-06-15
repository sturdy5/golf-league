<?php
include('./header.inc.php');
include('./validate-admin.php');
?>

<?php 
include('./navigation.inc.php');
?>

<div class="content">
	<form action="createpost.php" method="post" name="BlogPost" id="post" title="Blog Posting Form" dir="ltr" lang="en">
		<fieldset class="addPostFields">
			<p>
				<label for="title" class="blogTitle">Title:</label> 
				<span class="textbox">
				    <input name="blog_title" type="text" size="78" maxlength="80" />
				</span>
			</p>
			<p>
				<label for="entry" class="blogTitle">Blog Entry:</label>
				<span class="textbox">
				    <textarea rows="4" cols="80" name="blog_body" id="blog_body"></textarea>
				</span>
			</p>
			
			<div id="alignRight">
				<label for="submit">
				    <input name="submit" type="submit" value="Publish" />
				</label>
			</div>
		</fieldset>
	</form>
</div>

<?php
include("./utilities.inc.php"); 
?>

<?php
include('./footer.inc.php');
?>