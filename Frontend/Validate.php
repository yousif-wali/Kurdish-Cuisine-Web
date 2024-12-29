<?php
try{
    $url = "http://localhost/Kurdish%20Cuisine%20Web/Backend/";

    $data = "";
    switch($_POST["api"]){
        case "signup":
            if($_POST["Password"] != $_POST["Confirm_Password"]){
                setcookie("passwordsDonotMatch", true, time()+15, "/");
                header("Location: ./Signup");
                exit("Passowrds not matched");
            }
            $data = [
                "key"=>"$2y$10$1EEn.4EuvrIitJtuJBPl2uyVFv7OpcpBnwm/Y8PNdRv4w1eToXOzC",
                "Username"=>$_POST['Username'],
                "Password"=>$_POST["Password"],
                "Email" => $_POST["Email"],
                "Gender" => $_POST["Gender"]
            ];
            break;
        case "login":
            $key = "$2y$10$2R/7/p3Y4TkwTIRBqNvsmuDT4d4UNf/JfYT5HrCogYGjM09aB.bMa";
            break;
    }
    if($data!=""){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_POST, true);          // Use POST method
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',           // Backend expects JSON
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Send JSON data
        curl_setopt($ch, CURLOPT_COOKIEFILE, "");

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            setcookie("error", "Could not connect to the server", time()+15, "/");
        } else {
            echo "Response: " . $response;
        }

        curl_close($ch);
    }else{
        throw new Exception("Invalid Request");
    }
}catch(Exception $e){
    echo $e->getMessage();
}finally{
    switch($_POST["location"]){
        case "signup":
            session_start();
            $_SESSION["Username"] = $_POST["Username"];
            $_SESSION["Gender"] = $_POST["Gender"];
            $_SESSION["Email"] = $_POST["Gender"];
            header("Location: ./");
            break;
    }
}
?>
