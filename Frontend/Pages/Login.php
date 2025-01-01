<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "./Head.html";?>
    <title>Login</title>
    <style>@import "./Styles/General";</style>
</head>
<body>
    <form method="POST" action="./UserForm" class="form-control">
        <?php
        if(isset($_COOKIE["couldnotsignin"])){
            echo "<p class='text-danger'>Username or Password Error</p>";
        }
        ?>
        <input type="hidden" name="api" value="login"/>
        <input type="hidden" name="location" value="login"/>
        <section class="form-floating mb-3">
            <input id="Username" name="Username" class="form-control" placeholder="i"/>
            <label class="form-control" for="Username">Username</label>
        </section>
        <section class="form-floating mb-3">
            <input type="password" id="Passowrd" name="Password" class="form-control" placeholder="i"/>
            <label class="form-control" for="Password">Password</label>
        </section>

        <button name="Login" class="btn btn-success">Login</button>
        <span>Don't have an account? <a href="./Signup">Create One</a></span>
    </form>
</body>
</html>