<?php

include "includes/functions.inc.php";
include "templates/header.php";

session_start();

if (
    isset($_SESSION["username"]) && 
    authorMatchesPost($_SESSION["username"], $_GET["post_id"])
) {
    $postID = htmlspecialchars($_GET["post_id"], ENT_QUOTES);
    $post = getPostByID($postID);

    if ($post) {
        $postTitle = htmlspecialchars($post["post_title"], ENT_QUOTES);
        $postBody = htmlspecialchars($post["post_body"], ENT_QUOTES);

        $csrf_token = generateCSRFToken();

        echo 
        "<section class='post'>
            <form action='includes/edit_post.inc.php' method='POST'>
                <div class='form-input-group post-title-input'>
                    <label for='postTitle'>Post Title</label>
                    <input type='text' name='postTitle' id='postTitle' value='$postTitle'>
                </div>
                
        
                <div class='form-input-group'>
                    <label for='postBody'>Post body:</label>
                    <textarea name='postBody' id='postBody' class='create-post-body'>$postBody</textarea>
                </div>
                <input type='hidden' name='postID' value='$postID'>
                <input type='hidden' name='csrf_token' value='$csrf_token'>
                <button type='submit' name='submit'>Post</button>
            </form>
        </section>";
    }
}

include "templates/footer.php";