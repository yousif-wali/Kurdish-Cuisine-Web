<?php
require_once "./Database.php";
require_once "./Users.php";
require_once "./Posts.php";
require_once "./Likes.php";
require_once "./Comments.php";

$con = new MySQLiConnection('localhost', 'root', '', 'kurdish_cuisine');
//$con = new MySQLiConnection('localhost', 'root', '123457', 'kurdish_cuisine');

$db = new DB($con);

// Variables for database connections
$userDB = new Users($db);
$postsDB = new Posts($db);
$likesDB = new Likes($db);
$commentsDB = new Comments($db);

// Important for shipping/production Remove "http://localhost"
header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204); // No content
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403); // Forbidden
    echo json_encode(['error' => 'Only POST requests are allowed']);
    exit;
}

// Ensure the request is POST for JSON processing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read and decode JSON input
    $json_input = file_get_contents('php://input');
    $data = json_decode($json_input, true);

    // Check for JSON decoding errors
    if (json_last_error() !== JSON_ERROR_NONE) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(['error' => 'Invalid JSON input']);
        exit;
    }

    // Process the data (example: echoing it back)
    $success = false;
    $result = "";
    $proccessed = false;
    $error = "None";
    function verify_key($text, $key) {
        // Securely compare the provided text with the stored key
        return password_verify($text, $key);
    }
    
    //////////////////////////////////////
    //                                  //
    //              Routers             //
    //                                  //
    //////////////////////////////////////
    try{
        // Sign up
        if(verify_key("userSignUp", $data["key"])){
            $result = $userDB->insert($data["Username"], $data["Password"], $data["Email"], $data["Gender"],"Regular");
            if($result == "User inserted successfully"){
                $success = true;
            }
            $proccessed = true;
        }
        // Login
        if(verify_key("userLogin", $data["key"])){
            $result = $userDB->checkUser($data["Username"], $data["Password"]);
            if($result == "Success"){
                $success = true;
            }
            $proccessed = true;
        }
        // Delete
        if(verify_key("userDelete", $data["key"])){
            $result = $userDB->delete($data["Username"]);
            if($result == "Success"){
                $success = true;
            }
            $proccessed = true;
        }
        // Uploading File
        if(verify_key("requestingUploadFile", $data["key"])){
            $result = $postsDB->insert($data["Username"], $data["Title"], $data["Description"], $data["File"]);
            if($result == "Posts is successfully posted"){
                $success = true;
            }
            $proccessed = true;
        }
        // Get Posts
        if(verify_key("getAllPosts", $data["key"])){
            $result = $postsDB->getAllData();
            if($result){
                $success = true;
            }
            $proccessed = true;
        }
        // Likes
        if(verify_key("Like", $data["key"])){
            $result = $likesDB->Like($data["Username"], $data["Post_ID"]);
            if($result){
                $success = true;
            }
            $proccessed = true;
        }
        // Get Likes
        if(verify_key("getLikes", $data["key"])){
            $result = $likesDB->getLikes($data["Username"]);
            if($result){
                $success = true;
            }
            $proccessed = true;
        }
        // Remove Likes
        if(verify_key("deleteLike", $data["key"])){
            $result = $likesDB->deleteLikes($data["Username"], $data["Post_Id"]);
            if($result){
                $success = true;
            }
            $proccessed = true;
        }
        // Add Comment
        if(verify_key("comment", $data["key"])){
            $result = $commentsDB->Comment($data["Username"], $data["Post_Id"], $data["Comment"]);
            if($result){
                $success = true;
            }
            $proccessed = true;
        }
    }catch(Exception $e){
        $error = $e->getMessage();
    }

    $response = [
        'success' => $success,
        'result' => $result,
        'proccessed' => $proccessed,
        'received' => $data,
        'error' => $error
    ];

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode(['error' => 'Only POST method is allowed']);
}
?>