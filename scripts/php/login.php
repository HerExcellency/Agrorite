<?php
require_once 'functions.php';
require_once 'helpers/helper.php';


// Getting Post value
$email = $_POST["email"]; 
$password = $_POST["password"];
if (empty($email)) {
    return helper::Output_Error(null, "Email is required");
}
if($email === ''){
    return helper::Output_Error(null, "Email field cannot be empty");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return helper::Output_Error(null, "Please put in a valid email");
}
if (empty($password)) {
    return helper::Output_Error(null, "Password is required");
}
if($password === ''){
    return helper::Output_Error(null, "Password field cannot be empty");
}
$fetch = fetchUser($email);
if(array_key_exists('error',  $fetch)){
    return helper::Output_Error(null, "Invalid details");
}
if(count($fetch) === 0){
    return helper::Output_Error(null, "User not found");
}

$dbPassword = $fetch[0]->password;
if (substr($dbPassword, 0, 1) == "$"){
    // Password already converted, verify using password_verify
    $passwordVerify = password_verify($password, $dbPassword);
    if(!$passwordVerify){
        return helper::Output_Error(null, "Invalid Login Details");
    }else{
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['login'] = 'true';
            return helper::Output_Success(["success"=>"Login in was successful"]);
    }
}
else{
    // User still using the old MD5, update it!
    if (md5($password) != $dbPassword){
        return helper::Output_Error(null, "Invalid Login Details");
    }else{
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['login'] = 'true';
        return helper::Output_Success(["success"=>"Login in was successful"]);
    }
}
 
?>