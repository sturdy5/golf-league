<?php

class Blog {
	
	public $id;
	public $name;
	
	public $posts = array();
	
	public function toHTML() {
		$html = "";
		foreach ($this->posts as $post) {
			if ($post->published == 1) {
			    $html = $html . "<span class=\"post-title\">" . stripslashes($post->title) . "</span><br/><span class=\"post-date\">". $post->created . "</span><br/>";
			    $html = $html . "<div class=\"post-body\">" . stripslashes($post->body) . "</div>";
			}
		}
		
		return $html;
	}
	
}
?>