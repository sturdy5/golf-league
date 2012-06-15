<?php
include('./header.inc.php');

require_once('./dao/BlogDAO.php');
require_once('./model/Comment.php');
require_once('./model/Post.php');
require_once('./model/Blog.php');
?>

<?php 
include('./navigation.inc.php');
?>

<div class="content">
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
</div>

<?php
include('./utilities.inc.php'); 
?>
<?php
include('./footer.inc.php');
?>