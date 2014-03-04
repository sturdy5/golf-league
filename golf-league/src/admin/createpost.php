<?php
include("./requires.inc.php");
include("./config/loadConfiguration.php");

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