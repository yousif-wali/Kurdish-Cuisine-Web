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
	<section class="post-container">
        <section class="post">
            <img src="R.jfif" alt="Post Image" width="200">
            <section class="post-content">
                <section><h2>This is my title</h2></section>
                <section class="post-description">This is an amazing post! Feel free to like and comment below.</section>
                <section class="post-actions">
                    <button class="like-btn" onclick="toggleLike(this)">👍 Like</button>
                </section>
                <section class="comments-section">
                    <section class="comment-input">
                        <textarea type="text" id="commentInput" placeholder="Write a comment..."></textarea>
                        <button onclick="addComment()">Post</button>
                    </section>
                    <section class="comments-list" id="commentsList">
                        <!-- Comments will appear here -->
                    </section>
                </section>
            </section>
        </section>
    </section>
</body>
</html>