<?php
session_start();
function loggedin() : bool{
    return isset($_SESSION["Username"]);
}
if(!loggedin()){
    //header("Location: ./Login");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "./Pages/Head.html";?>
    <title>Kurdish Cuisine</title>
    <script src="./Script/General"></script>
    <style>@import "./Styles/Main";</style>
</head>
<body>


    <?php
    if(loggedin()){
        echo "<button class='btn btn-danger' onclick='window.location=`./Logout`'>logout</button>";
    }else{
        echo "<button class='btn btn-success' onclick='window.location=`./Login`'>login</button>";
    }
    ?>
	<section class="post-container" id="post-container">
    </section>
</body>
</html>