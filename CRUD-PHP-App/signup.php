<?php include("templates/header.php")?>

<form action="includes/signup.inc.php" method="POST">
    <div class="form-input-group">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
    </div>

    <div class="form-input-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
    </div>
    

    <div class="form-input-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
    </div>

    <div class="form-input-group">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password">
    </div>

    <button type="submit" name="submit">Log In</button>
</form>

<?php include("templates/footer.php")?>