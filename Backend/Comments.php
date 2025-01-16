<?php
include_once "./Database.php";

class Comments{
    private $db;

    public function __construct(DB $db){
        $this->db = $db;
    }

    public function Comment(string $Username, int $PostID, string $Comment){
        try{
            $queryString = "INSERT INTO `Comments` (Username, Post_Id, Comment) VALUES (?, ?, ?)";
            $result = $this->db->query($queryString, [$Username, $PostID, $Comment]);
            if($result){
                return "success";
            }else{
                throw new Exception("Could not make comment.");
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function deleteComment(string $Username, int $PostID){
        try{
            $queryString = "DELETE FROM Comments WHERE Username = ? and Post_Id = ?";
            $result = $this->db->query($queryString, [$Username, $PostID]);
            if($result){
                return "success";
            }else{
                throw new Exception("Could not delete comment.");
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}
?>