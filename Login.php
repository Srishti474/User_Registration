<?php require_once("Include/Session.php"); ?>
<?php require_once("Include/Styles.css"); ?>
<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php
if(isset($_POST["Submit"])){
    $Email=mysqli_real_escape_string($Connection, $_POST["Email"]);
    $Password=mysqli_real_escape_string($Connection, $_POST["Password"]);
    
        $Found_Account=Login_Attempt($Email,$Password);
        if($Found_Account){
            header('location: Welcome.php');
        }
        else{
            $_SESSION["message"]="Invalid Email or Password";
        }
        
    
}
?>

<html>
<head>
<title>Login</title>

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
    <?php echo Message();?>
    <?php echo SuccessMessage();?>
    </div>

<form action="Login.php" method="post">
<fieldset>
<div id="centerpage">
<span class="Fieldinfo">Email:</span><br><input type="email" Name="Email" value="" required><br>
<span class="Fieldinfo">Password:</span><br><input type="password" Name="Password" value="" required><br>
<br><input type="Submit" Name="Submit" value="Login"><br>
</div>
</fieldset>
</form>
</body>
</html>
