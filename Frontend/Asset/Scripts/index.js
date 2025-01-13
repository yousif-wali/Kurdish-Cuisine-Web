function postRequest(url, data) {
    return new Promise((resolve, reject) => {
      fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      })
        .then((response) => {
          if (!response.ok) {
            reject(`HTTP error! status: ${response.status}`);
          }
          return response.json();
        })
        .then((result) => resolve(result))
        .catch((error) => reject(error));
    });
  }
  
  // Usage
  const data = { key : "$2y$10$5dmfn54nPXUf315L3kV29eJcjOSPlKSR7O7ebCPvfNo3xzDQe/tYG" };
  postRequest("http://localhost/Kurdish%20Cuisine%20Web/Backend/", data)
    .then((data) => {
      console.log("Response from server:", data);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
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
      const userHolder = document.createElement("section");
      const newComment = document.createElement('section');

      const Time = document.createElement("span");
      const Username = document.createElement("span");
      const Comment = document.createElement("p");

      Time.textContent = "10:00:09";
      Username.textContent = "Username";
      Comment.textContent = commentInput.value.trim();

      newComment.classList.add('comment');
      userHolder.appendChild(Username);
      userHolder.appendChild(Time);
      newComment.appendChild(userHolder);
      newComment.appendChild(Comment);
      

      commentsList.appendChild(newComment);



      commentInput.value = '';
  }
}