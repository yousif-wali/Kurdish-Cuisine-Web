<?php
session_start();
if(!isset($_SESSION['Username'])){
    header("Location: ./Login");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "./Pages/Head.html";?>
    <title>Kurdish Cuisine</title>
</head>
<body>

</body>
</html>