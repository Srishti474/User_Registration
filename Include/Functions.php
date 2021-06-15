<?php require_once("Include/DB.php"); ?>
<?php

function Password_Encryption($Password){
    $BlowFish_Hash_Format="$2y$10$";
    $Salt_Length = 22;
    $Salt = Generate_Salt($Salt_Length);
    $Formating_BlowFish_With_Salt=$BlowFish_Hash_Format.$Salt;
    $Hash = crypt($Password,$Formating_BlowFish_With_Salt);
    return $Hash;
}

function Generate_Salt($length){
    $Unique_Random_String=md5(uniqid(mt_rand(),true));
    $Base64_String=base64_encode($Unique_Random_String);
    $Modified_Base64_String=str_replace('+','.',$Base64_String);
    $Salt=substr($Modified_Base64_String,0,$length);
    return $Salt;
}

function Password_Check($Password,$Existing_Hash){
    $Hash=crypt($Password,$Existing_Hash);
    if($Hash==$Existing_Hash){
        return true;
    }
    else{
        return false;
    }
}

function CheckEmailExistOrNot($Email){

    global $Connection;
    $Query="SELECT * FROM admin_panel WHERE email='$Email'";
    $Execute=mysqli_query($Connection,$Query);
    if(mysqli_num_rows($Execute)>0){
        return true;
    }
    else{
        return false;
    }

}

function Login_Attempt($Email,$Password){
 
    global $Connection;
    $Query="SELECT * FROM admin_panel where email='$Email'";
    $Execute=mysqli_query($Connection,$Query);
    if($admin=mysqli_fetch_assoc($Execute)){
        if(Password_Check($Password,$admin["password"])){
            return $admin;
        }
        else{
            return null;
        }
    }

}

function ConfirmAccountActiveStatus(){

    global $Connection;
    $Query="SELECT * FROM admin_panel WHERE active='On'";
    $Execute=mysqli_query($Connection,$Query);
    if(mysqli_num_rows($Execute)>0){
        return true;
    }
    else{
        return false;
    }

}


?>