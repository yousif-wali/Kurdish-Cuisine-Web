<?php
include "./Database";

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
            echo $e->getMessage();
        }
    }
}
?>