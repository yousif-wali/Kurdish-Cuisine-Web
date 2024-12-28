<?php
class FileUploader
{
    private $uploadDir;
    private $allowedExtensions;
    private $maxFileSize;

    public function __construct($uploadDir = './uploads/', $allowedExtensions = ['jpg', 'png'], $maxFileSize = 2 * 1024 * 1024){
        $this->uploadDir = rtrim($uploadDir, '/') . '/';
        $this->allowedExtensions = $allowedExtensions;
        $this->maxFileSize = $maxFileSize;

        if(!is_dir($this->uploadDir)){
            mkdir($this->uploadDir, 0755, true);
        }
    }
    public function upload($file){
        if(!isset($file) || $file['error'] !== UPLOAD_ERR_OK){
            return ['success' => false, 'message' => 'No file uploaded or there was an error during upload.'];
        }

        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Validate file extension
        if(!in_array($fileExtension, $this->allowedExtensions)){
            return ['success' => false, 'message' => "Invalid file type. Allowed types: " . implode(", ", $this->allowedExtensions)];
        }

        // Validate file size
        if ($fileSize > $this->maxFileSize){
            return ['success' => false, 'message' => "File size exceeds the maximum limit of " . ($this->maxFileSize / 1024 / 1024) . " MB."];
        }

        $newFileName = uniqid('', true) . '.' . $fileExtension;
        $destPath = $this->uploadDir . $newFileName;

        // Move the uploaded file
        if(move_uploaded_file($fileTmpPath, $destPath)){
            return ['success' => true, 'message' => "File uploaded successfully.", 'file_path' => $destPath];
        }else{
            return ['success' => false, 'message' => "Failed to move the uploaded file."];
        }
    }
}
?>