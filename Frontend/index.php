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
</head>
<body>
    <?php
    if(loggedin()){
        echo "<button class='btn btn-danger' onclick='window.location=`./Logout`'>logout</button>";
        echo "<br/>Welcome ".$_SESSION["Username"];
    }else{
        echo "<button class='btn btn-success' onclick='window.location=`./Login`'>login</button>";
        echo "<br/>Please login";
    }
    ?>
</body>
</html>