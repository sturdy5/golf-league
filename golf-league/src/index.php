<?php
include('./requires.inc.php');

include('./config/loadConfiguration.php');

include('./header.inc.php');
?>

<?php 
include('./navigation.inc.php');
?>

<div class="blog">
<?php 
    if ($_SESSION["admin"] == 1) {
?>
        <div class="addPost"><a href="admin-addPost.php">Add Post</a></div>
<?php
    }
    $blogDao = new BlogDAO();
    echo $blogDao->getBlogInformation()->toHTML();
?>
</div>


<?php
include('./utilities.inc.php'); 
?>
<?php
include('./footer.inc.php');
?>