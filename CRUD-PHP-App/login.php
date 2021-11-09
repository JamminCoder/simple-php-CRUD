<?php 

include("templates/header.php");

// If user is already logged in, return them to the index page.
session_start();
if (isset($_SESSION["username"])) {
    header("location: ../index.php");
    exit();
}

?>

<form action="includes/login.inc.php" method="POST">
    <div class="form-input-group">
        <label for="username">Username or Email:</label>
        <input type="text" name="username" id="username">
    </div>
    

    <div class="form-input-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
    </div>
    <button type="submit" name="submit">Log In</button>
</form>

<?php include("templates/footer.php")?>