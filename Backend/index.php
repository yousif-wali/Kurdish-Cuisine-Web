<?php
require_once "./Database.php";
require_once "./Users.php";
require_once "./Posts.php";
require_once "./Likes.php";
require_once "./Comments.php";

$con = new MySQLiConnection('localhost', 'root', '', 'kurdish_cuisine');
$db = new DB($con);

// Variables for database connections
$userDB = new Users($db);
$postsDB = new Posts($db);
$likesDB = new Likes($db);
$commentsDB = new Comments($db);

// Important for shipping/production Remove "http://localhost"
$allowed_origins = ['https://example.com', 'http://localhost'];
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if (in_array($origin, $allowed_origins)) {
    header("Access-Control-Allow-Origin: $origin");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
} else {
    header("HTTP/1.1 403 Forbidden");
    exit('Cross-origin request denied.');
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
    function verify_key($text, $key) {
        // Securely compare the provided text with the stored key
        return password_verify($text, $key);
    }
    
    //////////////////////////////////////
    //                                  //
    //              Routers             //
    //                                  //
    //////////////////////////////////////

    // Sign up
    if(verify_key("userSignUp", $data["key"])){
        $result = $userDB->insert("Bastory", "password", "email@gmail.com", "Male","Regular");
        if($result == "User inserted successfully"){
            $success = true;
        }
    }
    // Login
    if(verify_key("userLogin", $data["key"])){
        $result = $userDB->checkUser("Bastory", "passwords");
        if($result == "Success"){
            $success = true;
        }
    }

    $response = [
        'success' => $success,
        'result' => $result
    ];

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode(['error' => 'Only POST method is allowed']);
}
?>