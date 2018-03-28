<?php
require_once('DBUtils.php');
/*
require_once('../model/comment.php');
require_once('../model/post.php');
require_once('../model/blog.php');
*/
class BlogDAO {
	
	const SELECT_COMMENT_QUERY = "select body from comments where post_id = %s";
	const SELECT_POST_QUERY = "select id, title, body, published, created_at from posts order by updated_at desc, created_at desc, id desc";
	const INSERT_POST_QUERY = "insert into posts(id, title, body, published, created_at, updated_at) values (null, '%s', '%s', %s, NOW(), NOW())";
	const DELETE_POST_QUERY = "delete from posts where id = %s";
	const UPDATE_POST_QUERY = "update posts set title = '%s', body = '%s', published = %s, updated_at = NOW() where id = %s";
	
	/**
	 * Returns a <code>Blog</code> object that corresponds to the client id that is passed in.
	 * @param $clientId
	 * @return Blog
	 */
	public function getBlogInformation() {
		$blog = new blog();
		
		// get the posts for this blog...
		$blog->posts = $this->getBlogPosts();
		
		return $blog;
	}
	
	/**
	 * Saves the blog entry into the database.
	 * 
	 * @param $blogId
	 * @return unknown_type
	 */
	public function saveBlogPost($title, $body, $published) {
		$data = array($title, $body, $published);
		
		$data = DBUtils::escapeData($data);

		$query = vsprintf(self::INSERT_POST_QUERY, $data);
		
		$result = @mysqli_query($query);
		
		$postId = "";
		
		if ($result) {
			$postId = mysqli_insert_id();
		}else{
			throw new Exception("DB : " . mysqli_error());
		}
		
		return $postId;
	}
	
	public function deleteBlogPost($postId) {
		$query = sprintf(self::DELETE_POST_QUERY, $postId);
		
		$result = @mysqli_query($query);
		
		if (!$result) {
			throw new Exception("DB : " . mysqli_error());
		}
	}
	
	public function updateBlogPost($postId, $title, $body, $published) {
		$data = array($title, $body, $published, $postId);
		
		$data = DBUtils::escapeData($data);
		
		$query = vsprintf(self::UPDATE_POST_QUERY, $data);
		
		$result = @mysqli_query($query);
		
		if (!$result) {
			throw new Exception("DB : " . mysqli_error());
		}
	}
	
	private function getBlogPosts() {
		$posts = array();
		
		$results = @mysqli_query(self::SELECT_POST_QUERY);
		if ($results) {
			$count = mysqli_num_rows($results);
			for ($i = 0; $i < $count; $i++) {
				$row = mysqli_fetch_assoc($results);
				$post = new post();
				$post->id = $row["id"];
				$post->title = $row["title"];
				$post->body = $row["body"];
				$post->published = $row["published"];
				$post->created = $row["created_at"];
				
				array_push($posts, $post);
			}
			
			foreach ($posts as &$postItem) {
				// get the comments for the post
				$postItem->comments = $this->getPostComments($postItem->id);
			}
		} else {
			throw new Exception("DB : " . mysqli_error());
		}
		
		return $posts;
	}
	
	private function getPostComments($postId) {
		$comments = array();
		
		$query = sprintf(self::SELECT_POST_QUERY, $postId);
		$results = @mysqli_query($query);
		if ($results) {
			$count = mysqli_num_rows($results);
			for ($i = 0; $i < $count; $i++) {
				$row = mysqli_fetch_assoc($results);
				$comment = new comment();
				$comment->body = $row["body"];
				
				array_push($comments, $comment);
			}
		} else {
			throw new Exception("DB : " . mysqli_error());
		}
		
		return $comments;
	}
}
?>