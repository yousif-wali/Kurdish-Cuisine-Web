const url ="http://localhost/Kurdish%20Cuisine%20Web/Backend/"
function likesRequest(url, data){
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
  postRequest(url, data)
    .then((data) => {
      console.log("Response from server:", data);
      
      const post = document.getElementById("post-container");
      data.result.map((val, index)=>{
          post.innerHTML += `
          <section class="post">
                <img src="${url + "Post/" +val.Username +"/"+ val.Filename}" alt="Post Image" width="200">
                <section class="post-content">
                    <section><h2>${val.Title}</h2></section>
                    <section class="post-description">${val.Description}</section>
                    <section class="post-actions">
                    <button class="like-button" data-post="${val.ID}" onclick="toggleLike(this)">
                        <span class="like-icon">&#10084;</span> <!-- Unicode Heart Icon -->
                    </button>
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
          `;
      })
    })
    .catch((error) => {
      console.error("Error:", error);
    });

const getLikesData = {key: "$2y$10$0BYi3GBVPFy/3xvv6qVXae8.LP27KhuWpwUF7RFXlvimuyrr2La6K"};
likesRequest(url, data)
.then((data) => {
  // TODO: For each post, update the like state
})
.catch((error) => {
  console.error("Error:", error);
});
// Like button toggle
 function toggleLike(button) {
  const ID = button.getAttribute("data-post");
  const data = { key: "$2y$10$.ehrTtvlp1BqfIIl3s/e4e19go0Qi0dRWyw2e4f3m5fqsn.La0c.i" , Post_ID: ID, Username: Username};
  fetch(url, {
    method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
  })
  console.log(ID);
  button.classList.toggle('liked');
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