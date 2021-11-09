<?php

include "templates/header.php";
include "includes/functions.inc.php";

?>


<h1>Are you sure you want to delete this post??</h1>
<h3><a href="index.php" class="btn good">No! Bring me back to the home page.</a></h3>

<form action="includes/delete_post.inc.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
    <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($_GET['post_id'], ENT_QUOTES); ?>">
    <button class="btn warn" name="submit">Delete</button>
</form>



<?php

include "templates/footer.php";

?>