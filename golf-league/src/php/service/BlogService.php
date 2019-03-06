<?php 
include_once 'requires.inc.php';

if (isset($_GET["operation"])) {
    // the operation will map to one of the following values:
    //   - get 
    $operation = $_GET["operation"];
    switch ($operation){
        case "get":
            $dao = new BlogDAO();
            $blog = $dao->getBlogInformation();
            echo json_encode($blog);
            break;
        case "delete":
            // get the postId from the request
            if (array_key_exists("postId", $_GET)) {
                $postId = $_GET["postId"];
                $dao = new BlogDAO();
                $dao->deleteBlogPost($postId);
                echo json_encode("Deleted the post");
            } else {
                echo json_encode("Provide the id of the post to delete");
            }
            break;
        default:
            echo "Unsupported operation - " . $operation;
            break;
    }
}
?>