<?php
    session_start();
    $userID = $_SESSION["User ID"];
?>
<?php
    $updated_name = $_POST["name"];
    $updated_birthdate = $_POST["birthdate"];
    $updated_email = $_POST["email"];
    $updated_phone_number = $_POST["phone_number"];
?>
<?php
    include "user.php";
    $user = new User();
    $user = unserialize($_SESSION["User Information"]);
?>
<?php
    include "connection.php";
    $db = new DBConnection();
    $conn = $db->getConnection();
    $sql = "";
    $nameErr = $emailErr = $birthdateErr = $phone_numberErr = "";

    if(!is_null($updated_name)){
        if (!preg_match("/^[a-zA-Z ]*$/",$updated_name)) {
            $nameErr = "Only letters and white space allowed";
            echo "<script>alert('$nameErr');window.location.href='http://localhost:3000/FirstProject/php/my_account.php'</script>";
        }
        else{
            $sql = "UPDATE UserInfo SET name = '$updated_name' WHERE id = $userID;";
        }
    }
    if(!is_null($updated_birthdate)){
        if(!validateDate($updated_birthdate)){
            $birthdateErr = "Please input with the format : YYYY-MM-DD. Year must be from 1990 to 2020. Month must be from 01-12. Day must be from 01-31";
            echo "<script>alert('$birthdateErr');window.location.href='http://localhost:3000/FirstProject/php/my_account.php'</script>";
        }
        else{
            $sql = "UPDATE UserInfo SET birthdate = '$updated_birthdate' WHERE id = $userID;";
        }    
    }
    if(!is_null($updated_email)){
        if (!filter_var($updated_email, FILTER_VALIDATE_EMAIL)){
            $emailErr = "Invalid format";
            echo "<script>alert('$emailErr');window.location.href='http://localhost:3000/FirstProject/php/my_account.php'</script>";
        }
        else{
            $sql = "UPDATE UserInfo SET email = '$updated_email' WHERE id = $userID;";
        }
    }
    if(!is_null($updated_phone_number)){
        if(!validatePhoneNumber($updated_phone_number)){
            $phone_numberErr = "Please input with the format: (XXX) XXX-XXXX";
            echo "<script>alert('$phone_numberErr');window.location.href='http://localhost:3000/FirstProject/php/my_account.php'</script>";
        }
        else{
            $sql = "UPDATE UserInfo SET phone_number = '$updated_phone_number' WHERE id = $userID;";
        }
    }

    $conn->query($sql);
    echo "<script>window.location.href='http://localhost:3000/FirstProject/php/my_account.php'</script>";
?>
<?php
    function validateDate($date){
        if(strlen($date)==10){
            if(substr($date,4,1)=='-' && substr($date,7,1)=='-'){
                $year = substr($date,0,4);
                $month = substr($date,5,2);
                $day = substr($date,8,2);
                if(is_numeric($year) && is_numeric($month) && is_numeric($day)){
                    if(2020>=$year && $year>=1990 && 12>=$month && $month>=1 && 31>=$day && $day>=1){
                        return true;
                    }
                    else{
                        return false;
                    }
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    function validatePhoneNumber($number){
        if(is_numeric(substr($number,1,3)) && substr($number,0,1)=="(" && substr($number,4,1)==")"){
            if(is_numeric(substr($number,6,3)) && substr($number,9,1)=="-" && is_numeric((substr($number,10,4))) && substr($number,5,1)==" "){
                return true;
            }
            else{
                return false;
            }
        }
        else if( (substr($number,0,1)=="+" && is_numeric(substr($number,1,1))) || (is_numeric(substr($number,0,1)))){
            if((substr($number,0,1)=="+" && is_numeric(substr($number,1,1)))){
                if(substr($number,2,1)=="-" && is_numeric(substr($number,3,3)) && substr($number,6,1)=="-" && is_numeric(substr($number,7,3)) && substr($number,10,1)=="-" && is_numeric(substr($number,11,4))){
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                if(substr($number,1,1)=="-" && is_numeric(substr($number,2,3)) && substr($number,5,1)=="-" && is_numeric(substr($number,6,3)) && substr($number,9,1)=="-" && is_numeric(substr($number,10,4))){
                    return true;
                }
                else{
                    return false;
                }
            }
        }
    }
?>
