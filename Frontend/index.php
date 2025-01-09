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
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Links</title>

<style>
body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: left;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-color: #f0f0f0;
}

.button-container {
    text-align: left;
}

.button {
    display: inline-block;
    padding: 10px 20px;
    margin: 10px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.button:hover {
    background-color: #45a049;
}
</style>
    <?php include_once "./Pages/Head.html";?>
    <title>Kurdish Cuisine</title>
    <script src="./Script/General"></script>
	

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Post</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Webpage</title>

</head>
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
	
	<div class="button-container">
        <a href="index.html" class="button">Home</a>
        <a href="about.html" class="button">About</a>
    </div>
	    <div class="post-container">
        <div class="post">
            <img src="R.jfif" alt="Post Image" width="200">
            <div class="post-content">
                <div class="post-description">This is an amazing post! Feel free to like and comment below.</div>
                <div class="post-actions">
                    <button class="like-btn" onclick="toggleLike(this)">👍 Like</button>
                </div>
                <div class="comments-section">
                    <div class="comment-input">
                        <input type="text" id="commentInput" placeholder="Write a comment...">
                        <button onclick="addComment()">Post</button>
                    </div>
                    <div class="comments-list" id="commentsList">
                        <!-- Comments will appear here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Like button toggle
        function toggleLike(button) {
            button.classList.toggle('liked');
            button.textContent = button.classList.contains('liked') ? '❤️ Liked' : '👍 Like';
        }

        // Add comment
        function addComment() {
            const commentInput = document.getElementById('commentInput');
            const commentsList = document.getElementById('commentsList');
            
            if (commentInput.value.trim() !== '') {
                const newComment = document.createElement('div');
                newComment.classList.add('comment');
                newComment.textContent = commentInput.value.trim();
                commentsList.appendChild(newComment);
                commentInput.value = ''; // Clear input
            }
        }
    </script>
	    <div class="social-media-icons">
        <a href="https://www.facebook.com" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg"
			alt="Facebook" class="social-icon small"     width=" 50px" align="center"
    height=" 50px">
        </a>
        <a href="https://www.whatsapp.com" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" class="social-icon small"
			width="50px"
    height=" 50px">
        </a>
    </div>
</body>
</html>