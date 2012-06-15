<?php
require_once('./config.inc.php');
require_once('./dao/BlogDAO.php');
require_once('./model/Comment.php');
require_once('./model/Post.php');
require_once('./model/Blog.php');

$blogId = "";
if ($_POST["blog_title"] && $_POST["blog_body"]) {
    $blogDao = new BlogDAO();
    $blogId = $blogDao->saveBlogPost($_POST["blog_title"], $_POST["blog_body"], 1);
}

if ($blogId == "") {
    echo "Write failed - contact your system administrator";
} else {
    header("location: index.php");
}
?>