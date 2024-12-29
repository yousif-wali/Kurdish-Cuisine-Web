<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "./Head.html";?>
    <title>Signup</title>
    <style>@import "./Styles/General";</style>
</head>
<body>
    <form method="POST" action="./SignUpForm" class="form-control">
        <input type="hidden" name="api" value="signup"/>
        <input type="hidden" name="location" value="signup"/>
        <section class="form-floating mb-3">
            <input id="Username" name="Username" class="form-control" placeholder="i" required/>
            <label class="form-control" for="Username">Username</label>
        </section>
        <section class="form-floating mb-3">
            <input type="email" id="Email" name="Email" class="form-control" placeholder="i" required/>
            <label class="form-control" for="Email">Email</label>
        </section>
        <section class="form-floating mb-3">
            <input type="password" id="Passowrd" name="Password" class="form-control" placeholder="i" required/>
            <label class="form-control" for="Password">Password</label>
        </section>
        <section class="form-floating mb-3">
            <input type="password" id="Confirm_Passowrd" name="Confirm_Password" class="form-control" placeholder="i" required/>
            <label class="form-control" for="Confirm_Password">Confirm Password</label>
        </section>

        <label>Gender</label>
        <select class="form-control mb-3" name="Gender">
            <option value="Male" default>Male</option>
            <option value="Female">Female</option>
        </select>

        <?php if(isset($_COOKIE["passwordsDonotMatch"])){
            echo '<p class="text-danger">Error: passwords do not match</p>';
            }?>

        <button name="Signup" class="btn btn-primary">Sign up</button>
        <span>Already have an account? <a href="./Login">Login</a></span>
    </form>
</body>
</html>