<?php
include "./Database.php";

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
                echo "success";
            }else{
                throw new Exception("Could not send the like.");
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
?>