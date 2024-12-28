<?php
include "./Database.php";
include "./FileUploader.php";
class Posts{
    private $db;

    public function __construct(Db $db){
        $this->db = $db;
    }
    // This function insert data into `POSTS` table first. If the data successfuly inserted then uploads
    // the file. If the file gets saved then its name and the post's id would be stored in `Files` table.
    // Otherwise it should delete the attempt
    public function insert(string $Username, string $Title, string $Description, $file){
        try{
            $publish = date('Y-m-d H:i:s');
            $queryString = "INSERT INTO `Posts` (Username, Title, Description, PublishDate) VALUES (?, ?, ?, ?)";
            $result = $this->db->query($queryString, [$Username, $Title, $Description, $publish]);
            if($result){
                $isFileUploaded = $this->uploadFile($Username, $file);
                if($isFileUploaded == "success"){
                    $lastId = $this->selectLastId($Username);
                    $queryString = "INSERT INTO `Files` (Post_Id, Filename) VALUES (?, ?)";
                    $result = $this->db->query($queryString, [$lastId, $file["name"]]);
                }else{
                    $this->deleteLastAttempt();
                    throw new Exception("Error Code 101");
                }
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    // Uploading the file
    private function uploadFile(string $Username, $file) : string{
        try{
            $FileUploader = new FileUploader("./Posts/".$Username, ["jpg", "png"], 2 * 1024 * 1024);
            $FileUploadResult = $FileUploader->upload($file);
            if($FileUploadResult['success']){
                return "success";
            }else{
                throw new Exception("Failed to upload");
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    private function selectLastId(string $Username): int{
        try{
            $queryString = "SELECT ID FROM `POSTS` WHERE Username = ? ORDER BY Username desc";
            $result = $this->db->query($queryString, [$Username]);

            if($result){
                return $result["ID"];
            }else{
                throw new Exception("Could not file the post");
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    private function deleteLastAttempt(){
        try{
            $queryString = "DELETE FROM `POSTS`
            WHERE ID = (SELECT MAX(ID) FROM `POSTS`);";
            $result = $this->db->query($queryString);
            if($result){
                echo "success deleting the last post";
            }else{
                throw new Exception("Could not delete the last post");
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
?>