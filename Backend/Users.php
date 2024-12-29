<?php 
include_once "./Database.php";

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
                return "User inserted successfully";
            }else{
                throw new Exception("Could not insert user.");
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    // this function is used for login in users
    public function checkUser(string $Username, string $Password){
        try{
            $queryString = "SELECT Password from `Users` WHERE Username = ?";
            $result = $this->db->query($queryString, [$Username]);
            // If error accures, it could be $result getting back different datatype
            if(password_verify($Password, $result[0]["Password"])){
                return "Success";
            }else{
                throw new Exception("Could not Sign in");
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    // This function is to delete a user.
    public function delete(string $Username){
        try{
            $queryString = "DELETE FROM `Users` WHERE Username = ?";
            $result = $this->db->query($queryString, [$Username]);

            if($result){
                return "Success";
            }else{
                throw new Exception("Could not delete");
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    // This function retrieves data about users,
    // Please note: we should have great security for this function
    // As it is fetching critical data about our users.
    private function selectUser(string $Username){
        try{
            $queryString = "SELECT * FROM `Users` WHERE Username = ?";
            $result = $this->db->query($queryString, [$Username]);
            if($result){
                return $result;
            }else{
                throw new Exception("Could not select any user.");
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}
?>