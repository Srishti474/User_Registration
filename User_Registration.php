<?php require_once("Include/Session.php"); ?>
<?php require_once("Include/Styles.css"); ?>
<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Functions.php"); ?>

<?php

if(isset($_POST["Submit"])){
    $UserName=mysqli_real_escape_string($Connection, $_POST["UserName"]);
    $Email=mysqli_real_escape_string($Connection, $_POST["Email"]);
    $Password=mysqli_real_escape_string($Connection, $_POST["Password"]);
    $ConfirmPassword=mysqli_real_escape_string($Connection, $_POST["ConfirmPassword"]);
    $Token=bin2hex(openssl_random_pseudo_bytes(40));
    if(CheckEmailExistOrNot($Email)){
        $_SESSION["message"]="Email Already in Use";
        header('location: User_Registration.php');
    }
    global $Connection;
    $Hashed_Password=Password_Encryption($Password);
    $Query="INSERT INTO admin_panel(username,email,`password`,token,active) VALUES('$UserName','$Email','$Hashed_Password','$Token','OFF')";
    $Execute=mysqli_query($Connection,$Query);
    if($Execute){
        $sub = "Account Confirmation";
        //the message
        $msg = 'Hi'.$UserName.'Here is the link to confirm your account http://localhost/User_Registration/Activate.php?token='.$Token;
        //recipient email here
        $rec = "srishtiverma4600@gmail.com";

        if (mail($rec,$sub,$msg)) {
            $_SESSION["SuccessMessage"]="Check your Email for Activation";
            header("location: Login.php");
        } else {
            $_SESSION["message"]="Failed! Mail not sent";
            header('location: User_Registration.php');
        }
        
    }
    else{
        $_SESSION["message"]="Something went wrong";
        header('location: User_Registration.php');
    }
}
?>
<html>
<head>
<title>Register Here!</title>

<style>
    
input[type="text"],input[type="password"],input[type="email"]{
    margin: 5px;
    border: 1px solid dashed;
    background-color: rgb(221,216,212);
    width: 480px;
    padding: .5em;
    font-size: 1.5em;
}
input[type="Submit"]{
  background-color: #008CBA;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  
}

div#centerpage{
    width: 500px;
    margin: 0 auto;
}
.Fieldinfo{
    color:#f57f17;
    font-size: 1.5em;
    font-family: 'Times New Roman', Times, serif;
}

div.SuccessMessage{
    border: 2px solid #c0c0c0;
    padding-top: 1em;
    color: white;
    font-weight: bold;
    background-color: #00c853;
    font-size: 1.5em;
    margin: 0 auto;
    width: 400px;
    height: 40px;
    text-align: center;
    margin-bottom: 1em;
}

div.message{
    border: 2px solid #c0c0c0;
    padding-top: 1em;
    color: white;
    font-weight: bold;
    background-color: #d50000;
    font-size: 1.5em;
    margin: 0 auto;
    width: 400px;
    height: 40px;
    text-align: center;
    margin-bottom: 1em;
}
</style>
</head>
<body>
    <div>
    <?php echo SuccessMessage();?>
    <?php echo Message();?>
    </div>

<form action="User_Registration.php" method="post">
<fieldset>
<div id="centerpage">
<span class="Fieldinfo">UserName:</span><br><input type="text" Name="UserName" value="" required><br>
<span class="Fieldinfo">Email:</span><br><input type="email" Name="Email" value="" required><br>
<span class="Fieldinfo">Password:</span><br><input type="password" Name="Password" value="" required><br>
<span class="Fieldinfo">Confirm Password:</span><br><input type="password" Name="ConfirmPassword" value="" required><br>
<br><input type="Submit" Name="Submit" value="Submit"><br>
</div>
</fieldset>
</form>
</body>
</html>
