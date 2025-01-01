<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "./Head.html";?>
    <title>Post</title>
    <style>@import "./Styles/General";</style>
</head>
<body>
    <?php if(isset($_COOKIE["posed"])){
        echo "<p class='text-success'>Posted Successfully</p>";
    }?>
    <form class="form-control" enctype="multipart/form-data" action="./UploadPost" method="POST">
        <input type="hidden" name="api" value="post"/>
        <input type="hidden" name="location" value="post"/>
        <section class="form-floating mb-3">
            <input id="Title" name="Title" class="form-control" placeholder="i" required/>
            <label class="form-control" for="Title">Title</label>
        </section>
        <section class="form-floating mb-3">
            <input id="Description" name="Description" class="form-control" placeholder="i" required/>
            <label class="form-control" for="Description">Description</label>
        </section>
        <section>
            <input name="files" accepts="images/*" type="file" class="form-control"/>
        </section>

        <button class="btn btn-primary" name="Post">Post</button>
    </form>
</body>
</html>