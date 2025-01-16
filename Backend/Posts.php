<?php
include_once "./Database.php";
include "./FileUploader.php";
class Posts{
    private $db;

    public function __construct(Db $db){
        $this->db = $db;
    }
    public function getAllData(){
        $queryString = "SELECT 
        Posts.*, 
        Files.Filename, 
        GROUP_CONCAT(DISTINCT CONCAT(Comments.Username, '|||Username|||', Comments.Comment) ORDER BY Comments.Id desc SEPARATOR '|||comment|||seperator|||') AS CommentsArray, 
        COUNT(DISTINCT Likes.Username) AS TotalLikes 
    FROM 
        Posts 
    JOIN 
        Files ON Files.Post_Id = Posts.ID 
    LEFT JOIN 
        Comments ON Comments.Post_Id = Posts.ID 
    LEFT JOIN 
        Likes ON Likes.Post_Id = Posts.ID 
    GROUP BY 
        Posts.ID, Files.Filename 
    ORDER BY 
        Posts.ID;";
        $result = $this->db->query($queryString);
        if($result){
            return $result;
        }else{
            echo "Failed";
        }
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
                if($isFileUploaded['success'] == true){
                    $lastId = $this->selectLastId($Username);
                    $queryString = "INSERT INTO `Files` (Post_Id, Filename) VALUES (?, ?)";
                    // TODO: Replate $file["files"]["name"] to the updated uniq id from file upload
                    $result = $this->db->query($queryString, [$lastId, $isFileUploaded['newFileName']]);
                    return "Posts is successfully posted";
                }else{
                    $this->deleteLastAttempt();
                    throw new Exception("Error Code 101: ". $isFileUploaded);
                }
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    // Uploading the file
    private function uploadFile(string $Username, $file) : array{
        try{
            $FileUploader = new FileUploader("./Posts/".$Username, ["jpg", "png"], 5 * 1024 * 1024);
            $FileUploadResult = $FileUploader->upload($file);
            if($FileUploadResult['success']){
                return $FileUploadResult;
            }else{
                throw new Exception("Failed to upload (Reason) " . $FileUploadResult["message"]);
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    private function selectLastId(string $Username): int{
        try{
            $queryString = "SELECT ID FROM `POSTS` WHERE Username = ? ORDER BY ID desc limit 1";
            $result = $this->db->query($queryString, [$Username]);

            if($result){
                return $result[0]["ID"];
            }else{
                throw new Exception("Could not file the post");
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    private function deleteLastAttempt(){
        try{
            $queryString = "DELETE FROM `POSTS`
            WHERE ID = (SELECT MAX(ID) FROM `POSTS`);";
            $result = $this->db->query($queryString);
            if($result){
                return "success deleting the last post";
            }else{
                throw new Exception("Could not delete the last post");
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}
?>