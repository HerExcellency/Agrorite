<?php 
require_once 'functions.php';
require_once 'helpers/helper.php';
//$baseUrl = 'http://localhost/agro';

$uploadDir = '../../assets/img/user/'; 
function genRandom($length){
    $char = 'abcdefghijklmnopqrstuvwxyzABCCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
    $random = '';
    for($i = 0; $i < $length; $i++){
        $index = rand(0, strlen($char) - 1);
        $random .= $char[$index]; 
    }
    return $random;
}
 
// If form is submitted 
if(isset($_POST['userEmail'])){ 
    // Get the submitted form data 
    $email = $_POST['userEmail']; 
    $file = isset($_FILES['userPicture']) ? true : false;
    //to salt the image
    $random = genRandom(10);
    // Check whether submitted data is not empty 
    if(!empty($email)){ 
        // Validate email 
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){ 
            return helper::Output_Error(null, "Invalid User ");
        }elseif($file){ 
            /**
             * CHECK IF A USER EXIST WITH THE EMAIL ADDRESS
             */
            $fetch = fetchUser($email);
            // database error
            if(array_key_exists('error',  $fetch)){
                return helper::Output_Error(null, "Opps there was an error performing this task please try again later");
            }
            if(count($fetch) === 0){
                return helper::Output_Error(null, "User does not exist");
            }
            $uploadStatus = 1; 
            // Upload file 
            $uploadedFile = ''; 
            if(!empty($_FILES["userPicture"]["name"])){ 
                 $imgName = $_FILES["userPicture"]["name"];
                 $saltImg = $random . '-' .$imgName;
                // File path config 
                $fileName = basename($saltImg); 
                $targetFilePath = $uploadDir . $fileName; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
                // Allow certain file formats 
                $allowTypes = array('jpg', 'png', 'jpeg', 'PNG', 'JPG', 'JPEG'); 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["userPicture"]["tmp_name"], $targetFilePath)){ 
                        $uploadedFile = $fileName; 
                    }else{ 
                        $uploadStatus = 0; 
                        return helper::Output_Error(null, "Sorry, there was an error uploading your file."); 
                    } 
                }else{ 
                    $uploadStatus = 0; 
                    return helper::Output_Error(null, "Sorry, JPG, JPEG, & PNG files are allowed to upload."); 
                } 
            } 
            if($uploadStatus == 1){                 
                // Update form data in the database 
                $update = updatePicture($email, $uploadedFile);
                if($update === TRUE){ 
                    return helper::Output_Success(["success"=>"Your Upload was successful"]);
                } else{
                    return helper::Output_Error(null, "There was an error uploading your image");
                }
            } 
        } else{
            return helper::Output_Error(null, "Please upload a file"); 
        }
    }else{ 
        return helper::Output_Error(null, "User could not be verified"); 
    } 
} 
 