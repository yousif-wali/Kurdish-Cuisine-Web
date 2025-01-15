<?php
include_once "./Database.php";

class Likes{
    private $db;

    public function __construct(DB $db){
        $this->db = $db;
    }

    public function Like(string $Username, int $Post_Id){
        try{
            $queryString = "INSERT INTO Likes (Username, Post_Id) VALUES (? , ?)";
            $result = $this->db->query($queryString, [$Username, $Post_Id]);
            if($result){
                return "success";
            }else{
                throw new Exception("Could not send the like.");
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function getLikes(string $Username){
        try{
            $queryString = "SELECT * FROM Likes WHERE Username = ?";
            $result = $this->db->query($queryString, [$Username]);
            if($result){
                return $result;
            }else{
                throw new Exception("Could not get likes.");
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function deleteLikes(string $Username, int $Post_Id){
        try{
            $queryString = "DELETE FROM Likes WHERE Username = ? and Post_Id = ?";
            $result = $this->db->query($queryString, [$Username, $Post_Id]);
            if($result){
                return "success";
            }else{
                throw new Exception("Could not remove like.");
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}
?>