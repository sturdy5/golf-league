<html>
    <head>
        <title>Test Page</title>
        <link href="theme/style.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="./js/selector.js"></script>
        <script type="text/javascript">

        var showMenu = function() {
            dojo.toggleClass("menuLink", "active");
            dojo.toggleClass("wrap", "active");
            return false;
        }
        
        </script>
<?php 
        include_once("./utils/dojo.inc.php");
?>
    </head>
<body id="body">
<!--Pattern HTML-->
  <div id="pattern" class="pattern">
    <!--Begin Pattern HTML-->
		<div class="wrap" id="wrap">
			<a href="#menu" id="menuLink" class="menu-link" onclick="return showMenu()">Menu</a>
			<nav id="menu" role="navigation">
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">About</a></li>
					<li><a href="#">Products</a></li>
					<li><a href="#">Services</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
			</nav>
			<div class="lorem mod">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer iaculis dignissim orci viverra venenatis. Nulla sit amet quam at nisl sagittis adipiscing in a ligula. Nam in nisi neque. Ut in ipsum eget justo dignissim accumsan a sit amet neque. Nulla facilisi. Aliquam erat volutpat. Aliquam aliquet bibendum mollis. Aliquam erat volutpat. Sed commodo elit ac neque eleifend in commodo justo elementum. Curabitur tristique, odio id convallis aliquet, nibh augue sollicitudin lacus, at fermentum sem dolor eu lacus. Proin gravida dui in libero aliquet quis egestas odio dictum. Fusce in ligula vitae ante mollis viverra. Curabitur nibh felis, ornare ut tempor sed, lobortis id elit. Phasellus nec semper lorem. Pellentesque erat augue, tincidunt sed vulputate et, congue nec felis. Sed ligula metus, condimentum non commodo et, varius varius nisi.</p>
						
						<p>Nunc arcu justo, elementum ac accumsan id, porttitor ac sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lectus eros, dignissim sit amet viverra et, vulputate gravida dui. Donec at mattis tellus. Suspendisse nisi purus, porttitor in lacinia ornare, malesuada non dolor. Praesent ligula massa, blandit nec consequat et, sagittis ut purus. Aliquam erat volutpat. Maecenas a arcu ligula. Proin vitae eros purus, eu adipiscing orci. Nunc vestibulum, ante quis venenatis facilisis, lacus arcu gravida arcu, eget varius nibh lacus et leo. Aliquam lacinia, mi et convallis tincidunt, massa tellus accumsan felis, at consequat lacus ligula non leo. Pellentesque auctor ipsum lorem, ut feugiat purus. Mauris sed tellus orci, in pharetra dui. Morbi vestibulum lectus nec nulla bibendum mollis.</p>
						
						<p>Donec nulla nisi, dictum auctor aliquet a, ultrices quis ipsum. Nam bibendum arcu in quam condimentum ut aliquet odio luctus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacus nulla, laoreet a fermentum vel, scelerisque sed mi. In consectetur magna sed leo scelerisque id mattis enim vulputate. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In cursus vulputate mauris et semper. Nam sed rhoncus justo. Duis quis orci quis lorem egestas mattis et in risus. Aenean justo eros, luctus sit amet ultricies et, interdum non est.</p>			
			</div>
		</div>
	</div>
	<!--End Pattern HTML-->
	
	<div class="container">	
		<section class="pattern-description">
			<h1 id="left">The Left Nav Flyout</h1>
      <p>From <a href="http://bradfrostweb.com/blog/web/responsive-nav-patterns/">Responsive Navigation Patterns</a>:</p>
			<p>Facebook popularized a left navigation for mobile that&#8217;s quite unique. The nav is accessed by a menu icon, which reveals a tray that <a href="http://stephanierieger.com/wp-content/uploads/2012/01/sliding-menu.png">slides in from the left</a> and moves the main content over to the right. </p>
			<h3>Pros</h3>
			<ul>
			<li><strong>Extendable</strong>- While other nav techniques don&#8217;t work very well if you have a lot of list items, this approach provides a lot of space to expand. I think that&#8217;s why Facebook took to it.</li>
			<li><strong>Good looking</strong>- This menu is very sophisticated and advanced, so it definitely has a wow factor to it.</li>
			<li><strong>Facebook conventions </strong>- Facebook mobile users will be used to this pattern already since the web and native Facebook mobile apps utilize this left tray system.</li>
			</ul>
			<h3>Cons</h3>
			<ul>
			<li><strong>Advanced</strong>- While the other methods modify simple elements, this shelf method has a lot of moving parts. As <a href="http://stephanierieger.com/a-plea-for-progressive-enhancement/">Stephanie Rieger pointed out</a>, the Obama site navigation broke on everything but the most sophisticated devices. If your project is meant for a broader audience, you want to be very careful if choosing this approach.</li>
			<li><strong>Doesn&#8217;t scale well</strong>- this method is quite unique to mobile and doesn&#8217;t necessarily scale up to large screens easily. You can run a risk of essentially maintaining two separate navs for small and large screens.</li>
			<li><strong>Potentially confusing</strong>- When I first saw Facebook&#8217;s new mobile nav, I actually thought it was broken. Keeping a hint of the content on the right seems a bit weird to me, but this is all personal preference.</li>
			</ul>
			<h3>In The Wild</h3>
			<ul>
			<li><a href="http://www.barackobama.com/">Barack Obama</a></li>
			</ul>
			<h3>Resources</h3>
			<ul>
			<li><a href="http://stephanierieger.com/a-plea-for-progressive-enhancement/">A Plea for Progressive Enhancement</a></li>
			<li><a href="http://jasonweaver.name/lab/offcanvas/variations/">Off Canvas</a></li>
			</ul>		</section>
		<footer role="contentinfo">   
			<div>
				<nav id="menu">
					<a href="http://bradfrost.github.com/this-is-responsive/patterns.html">&larr;More Responsive Patterns</a>
				</nav>
			</div>
		</footer>
	</div>
</body>
</html>