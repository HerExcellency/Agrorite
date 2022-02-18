<?php
require_once "helpers/Database.php";
    if(!Database::$conn){
        Database::Create_Connection();
    }

    function fetchUser($email){
        $fetch = sprintf('SELECT * FROM `agroriters` WHERE `email` = "%s" && `verify` = 1', $email);
        return Database::Query($fetch);
    }
    
    function fetchUserReg($email){
        $fetch = sprintf('SELECT * FROM `agroriters` WHERE `email` = "%s"', $email);
        return Database::Query($fetch);
    }
    
    function fetchUserId($id){
        $fetch = sprintf('SELECT * FROM `agroriters` WHERE `id` = "%s" && `verify` = 1', $id);
        return Database::Query($fetch);
    }

    //select count from user farms
    function fetchUserFarm($id){
        $fetch = sprintf('SELECT * FROM `investment` WHERE `agroriter_id` = "%d" ORDER BY `id` DESC', $id);
        $countId = Database::Query($fetch, 'count');
        return $countId;
    }
    //select count from user farms
    function fetchUserFarmCount($id){
        $fetch = sprintf('SELECT * FROM `investment` WHERE `agroriter_id` = "%d" AND `status`=0 ORDER BY `id` DESC', $id);
        $countId = Database::Query($fetch, 'count');
        return $countId;
    }
    function pendingInvestment($id){
        $fetch = sprintf('SELECT * FROM `invoices` WHERE `agroriter_id` = "%d" AND `status`= 0 ORDER BY `id` DESC', $id);
        $countId = Database::Query($fetch, 'count');
        return $countId;
    }
    //check expire
    function farmExpire($id){
        $fetch = sprintf('SELECT * FROM `investment` WHERE `agroriter_id` = "%d" AND `status`=0 ORDER BY `id` DESC', $id);
        $countId = Database::Query($fetch, 'count');
        return $countId;
    }
    //select all farms for investment for index page
    function fetchAllFarmsLimit(){
        $fetch = 'SELECT * FROM `farms` ORDER BY `id` DESC LIMIT 4';
        $countId = Database::Query($fetch, 'all-farm');
        return $countId;
    }
     //select all closed farms
     function fetchAllFarmsClosed(){
        $fetch = 'SELECT * FROM `farms` WHERE `status` = "so" ORDER BY `id` DESC';
        $countId = Database::Query($fetch, 'all-farm');
        return $countId;
    }
    //select all open and coming soon farms
    function fetchAllFarmsOpened(){
        $fetch = 'SELECT * FROM `farms` WHERE `status` = "o" ORDER BY `id` DESC';
        $countId = Database::Query($fetch, 'all-farm');
        return $countId;
    }
    //select all open and coming soon farms
    function fetchAllFarmsSoon(){
        $fetch = 'SELECT * FROM `farms` WHERE `status` = "os" ORDER BY `id` DESC';
        $countId = Database::Query($fetch, 'all-farm');
        return $countId;
    }
    //select all open and coming soon farms
    function fetchAllFarmsInvestment(){
        $fetch = 'SELECT * FROM `farms` ORDER BY `id` DESC';
        $countId = Database::Query($fetch, 'all-farm');
        return $countId;
    }
    // fetch farm details
    function fetchFarmDetails($slug){
        $fetch = sprintf('SELECT * FROM `farms` WHERE `id_name` = "%s"', $slug);
        $countId = Database::Query($fetch, 'details');
        return $countId;
    }
    function fetchFarmDetailsById($id){
        $fetch = sprintf('SELECT * FROM `farms` WHERE `id` = "%d"', $id);
        $countId = Database::Query($fetch);
        return $countId;
    }
    //REGISTER NEW AGRORITER
    function registerAgroriter($firstname, $lastname, $email, $phone, $userNationality, $userResidence, $password, $verifycode, $date, $time){
        $fetch = sprintf('INSERT INTO `agroriters` (`fname`, `lname`, `email`, `phone`, `nationality`, `country`, `password`, `verify_code`, `date_created`, `time_created`) VALUE("%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s")', $firstname, $lastname, $email, $phone, $userNationality, $userResidence, $password, $verifycode, $date, $time);
        return Database::Query($fetch, 'register');
    }
    //INSERT FARM INVOICE DETAILS
    function sponsorFarm($farmId, $userId, $amount, $invoice, $date, $time, $unit){
        $fetch = sprintf('INSERT INTO `invoices` (`amount`, `agroriter_id`, `farm_id`, `invoice_code`, `date_created`, `time_created`, `farm_unit`) VALUE("%s", "%s", "%s", "%s", "%s", "%s", "%s")', $amount, $userId, $farmId, $invoice, $date, $time, $unit);
        return Database::Query($fetch, 'sponsor');
    }
    //password reset
    function resetPassword($email, $resetPin){
        $fetch = sprintf('UPDATE `agroriters` SET `forgotpasscode` = "%s" WHERE `email` = "%s"', $resetPin, $email);
        return Database::Query($fetch, 'update');
    }
    //password update
    function updatePassword($email, $password){
        $fetch = sprintf('UPDATE `agroriters` SET `password` = "%s", `forgotpasscode` = "" WHERE `email` = "%s"', $password, $email);
        return Database::Query($fetch, 'update');
    }
    //UPDATE AGRORITER ACCOUNT
    function updateAgroriter($firstname, $lastname, $email, $phone, $residence, $nationality, $gender, $dob){
        $fetch = sprintf('UPDATE `agroriters` SET `fname` = "%s", `lname` = "%s", `phone` = "%s", `country` = "%s", `nationality`= "%s", `sex` = "%s", `dob` = "%s" WHERE `email` = "%s"', $firstname, $lastname, $phone, $residence, $nationality, $gender, $dob, $email);
        return Database::Query($fetch, 'update');
    }
    //UPDATE AGRORITER APP ACCOUNT
    function updateAppAgroriter($street_add, $city, $state, $country, $id){
        $fetch = sprintf('UPDATE `agroriters` SET `street_add` = "%s", `city` = "%s", `state` = "%s", `country` = "%s" WHERE `id` = "%s"', $street_add, $city, $state, $country, $id);
        return Database::Query($fetch, 'update');
    }
    //UPDATE AGRORITER APP SOCIALS
    function updateAppSocials($twitter, $facebook, $instagram, $id){
        $fetch = sprintf('UPDATE `agroriters` SET `twitter` = "%s", `facebook` = "%s", `instagram` = "%s" WHERE `id` = "%s"', $twitter, $facebook, $instagram, $id);
        return Database::Query($fetch, 'update');
    }
    //UPDATE AGRORITER NEXT OF KIN
    function updatenextOfKin($fullname, $email, $phone, $address, $relationship){
        $fetch = sprintf('UPDATE `agroriters` SET `kin_name` = "%s", `kin_phone` = "%s", `kin_add` = "%s", `relationship` = "%s" WHERE `email` = "%s"', $fullname, $phone, $address, $relationship, $email);
        return Database::Query($fetch, 'update');
    }
    //UPDATE AGRORITER APP NEXT OF KIN
    function updateAppNok($fullname, $id, $phone, $address, $relationship){
        $fetch = sprintf('UPDATE `agroriters` SET `kin_name` = "%s", `kin_phone` = "%s", `kin_add` = "%s", `relationship` = "%s" WHERE `id` = "%s"', $fullname, $phone, $address, $relationship, $id);
        return Database::Query($fetch, 'update');
    }
    //UPDATE AGRORITER NEXT OF KIN
    function updateAccountDetails($bankname, $accountname, $accountnumber, $email){
        $fetch = sprintf('UPDATE `agroriters` SET `bank_name` = "%s", `bank_acct_number` = "%s", `bank_acct_name` = "%s" WHERE `email` = "%s"', $bankname, $accountnumber, $accountname, $email);
        return Database::Query($fetch, 'update');
    }
    //UPDATE AGRORITER APP Bank
    function updateAppBank($bank_name, $bank_acct_name, $bank_acct_number, $id){
        $fetch = sprintf('UPDATE `agroriters` SET `bank_name` = "%s", `bank_acct_name` = "%s", `bank_acct_number` = "%s" WHERE `id` = "%s"', $bank_name, $bank_acct_name, $bank_acct_number, $id);
        return Database::Query($fetch, 'update');
    }
    //validate password reset pin
    function checkPwdPin($pin){
        $fetch = sprintf('SELECT * FROM `agroriters` WHERE `forgotpasscode` = "%s"', $pin);
        return Database::Query($fetch);
    }
    //verify account
    function checkVerifyPin($pin){
        $fetch = sprintf('SELECT * FROM `agroriters` WHERE `verify_code` = "%s"', $pin);
        return Database::Query($fetch, 'pin-reset');
    }
    //VERIFY AGRORITER 
    function updateAccountActivation($id){
        $fetch = sprintf('UPDATE `agroriters` SET `verify` = 1, `verify_code` = "" WHERE `id` = "%s"', $id);
        return Database::Query($fetch, 'update');
    }
    //UPDATE INVESTMENT
    function updateInvestment($id){
        $fetch = sprintf('UPDATE `investment` SET `status` = 1 WHERE `id` = "%s"', $id);
        return Database::Query($fetch, 'update');
    }
    //get latest farm update status
    function getFarmStatus($id){
        $fetch = sprintf('SELECT * FROM `farm_update` WHERE `farms_id` = "%d" ORDER BY created DESC LIMIT 1', $id);
        return Database::Query($fetch);
    }
    //get all farm update status
    function getAllFarmStatus($id){
        $fetch = sprintf('SELECT * FROM `farm_update` WHERE `farms_id` = "%d" ORDER BY created DESC', $id);
        return Database::Query($fetch);
    }
    //get all farm update status Images
    function getFarmStatusImage($id){
        $fetch = sprintf('SELECT * FROM `update_image` WHERE `farm_update_id` = "%d" ORDER BY id DESC', $id);
        return Database::Query($fetch);
    }
    

    //UPDATE USER PROFILE PICTURE 
    function updatePicture($email, $picture){
        $fetch = sprintf('UPDATE `agroriters` SET `picture` = "%s" WHERE `email` = "%s"', $picture, $email);
        return Database::Query($fetch, 'update');
    }



    //to set date joined to days ago
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hr',
            'i' => 'min',
            's' => 'sec',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    //get email subscriber
    function getSubscriber($email){
        $fetch = sprintf('SELECT * FROM `subscription` WHERE `email` = "%s"', $email);
        return Database::Query($fetch, 'subscribers');
    }
    //register email subscriber
    function insertSubscriber($email){
        $fetch = sprintf('INSERT INTO `subscription` (`email`) VALUE("%s")', $email);
        return Database::Query($fetch, 'register');
    }

    
?>