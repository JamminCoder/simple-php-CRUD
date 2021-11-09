<?php 

include "templates/header.php"; // session_start() is called in header.php.
include "includes/functions.inc.php";

// Load blog posts from database
	// If user is logged in and blog post author is user, then give the user the option to delete or edit the post
	// Display title
	// Display first 75 chars of blog post.


if ($_SESSION["username"] && $_GET["message"] === "login_success") {
	echo "<h2>Hello, " . htmlspecialchars($_SESSION["username"], ENT_QUOTES) . "!</h2>";
}

?>

<div class="blog-posts-list">
	<?php
		// Sets $_SESSION["csrf_token"] to a random string and returns its value
		$csrf_token = generateCSRFToken();
		
		$posts = getPosts();
		
		if ($posts !== false) {
			foreach($posts as $post) {
				$postTitle = htmlspecialchars($post["post_title"], ENT_QUOTES);
				$postBody = htmlspecialchars($post["post_body"], ENT_QUOTES);
				$postAuthor = htmlspecialchars($post["post_author"], ENT_QUOTES);
				$postID = htmlspecialchars($post["post_id"], ENT_QUOTES);

				echo 
				"<div class='post'>" . 
					"<div class='post-header'>" . 
						"<span class='post-header-item post-title'>$postTitle</span>" .
						"<span class='post-header-item post-author'>Author: $postAuthor</span>";

						// If user is logged in, then give them the option to update or delete the post
						if (isset($_SESSION["username"]) && authorMatchesPost($_SESSION["username"], $postID)) {
							echo 
							"<span class='post-header-item btn good'>
								<a href='edit_post.php?post_id=$postID'>Edit</a>
							</span>";
							echo 
							"<span class='post-header-item btn warn form-link'>
								<a href='delete_post.php?post_id=$postID'>Delete</a>
							</span>";
						}
				echo
					"</div>" . 
					"<div class='post-body'>" .
						$postBody . 
					"</div>" .
				"</div>";
			}
		} else {
			echo "<h2>No Posts yet!</h2>";
		}
		
	?>
</div>


<?php include("templates/footer.php")?>
