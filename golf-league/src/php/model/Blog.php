<?php

class Blog {
	
	public $id;
	public $name;
	
	public $posts = array();
	
	public function toHTML() {
		$html = "";
		foreach ($this->posts as $post) {
			if ($post->published == 1) {
				$html = $html . "<article class=\"post\"><header class=\"entry-header\">";
				$html = $html . "<div class=\"entry-meta\"><span class=\"posted-on\"><time class=\"entry-date published\" date=\"" . $post->created . "\">" . date('l, F d', strtotime($post->created)) . "</time></span></div>";
			    $html = $html . "<h1 class=\"entry-title\">" . stripslashes($post->title) . "</h1></header>";
			    $html = $html . "<div class=\"entry-content\"><p>" . stripslashes($post->body) . "</p></div>";
			    $html = $html . "</article>";
			}
		}
		
		return $html;
	}
	
}
?>