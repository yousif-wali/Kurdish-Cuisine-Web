<?php 
include "./Database.php";

class Users{
    private $db;

    public function __construct(DB $db){
        $this->db = $db;
    }
    // Inserting User into table :: useful for sign up.
    public function insert(string $Username, string $Password, string $Email, string $Gender, string $Role){
        try{
            $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
            $lastOnline = date('Y-m-d H:i:s');
            $signedUpDate = date('Y-m-d');
            $queryString = "INSERT INTO `Users` (Username, Password, Email, Gender, Role, LastOnline, SignedUpDate) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $result = $this->db->query($queryString, [$Username, $hashedPassword, $Email, $Gender, $Role, $lastOnline, $signedUpDate]);
            if($result){
                echo "User inserted successfully";
            }else{
                throw new Exception("Could not insert user.");
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
?>