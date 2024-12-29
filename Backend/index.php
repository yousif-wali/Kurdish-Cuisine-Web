<?php
require "./Users.php";
require "./Posts.php";
require "./Likes.php";
require "./Comments.php";
require "./Database.php";

$con = new MySQLiConnection('localhost', 'root', '', 'Users');
$db = new DB($con);

// Variables for database connections
$userDB = new Users($db);
$postsDB = new Posts($db);
$likesDB = new Likes($db);
$commentsDB = new Comments($db);

?>