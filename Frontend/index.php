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
    <script defer src="./Script/General"></script>
    <style>@import "./Styles/Main";</style>
</head>
<body>


    <?php
    if(loggedin()){
        echo "<button class='btn btn-danger top-left-button' onclick='window.location=`./Logout`'>logout</button>";
        echo "<button class='btn btn-primary top-right-button' onclick='window.location=`./Posts`'>Post</button>";
        $Username = $_SESSION["Username"];
        echo "<script>const Username = '$Username';</script>";
    }else{
        echo "<button class='btn btn-success top-left-button' onclick='window.location=`./Login`'>login</button>";
        echo "<script>const Username = null;</script>";
    }
    ?>
	<section class="post-container" id="post-container">
    </section>
</body>
</html>