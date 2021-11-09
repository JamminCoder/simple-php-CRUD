
<?php

    include "templates/header.php";
    include "includes/functions.inc.php";
    if (!isset($_SESSION["username"])) {
        header("location: index.php");
        exit();
    }
?>

<section class="">
    <form action="includes/create_post.inc.php" method="POST">
        <div class="form-input-group post-title-input">
            <label for="postTitle">Post Title</label>
            <input type="text" name="postTitle" id="postTitle">
        </div>
        

        <div class="form-input-group post-body-input">
            <label for="postBody">Post body:</label>
            <textarea name="postBody" id="postBody"placeholder="Make a post!" class='create-post-body'></textarea>
        </div>
        <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
        <button type="submit" name="submit">Post</button>
    </form>
</section>


<?php include("templates/footer.php");?>