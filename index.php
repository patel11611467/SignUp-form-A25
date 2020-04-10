
<!DOCTYPE HTML>  
<html>
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
  <title>Sign Up</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
.error {color: #FF0000;}
</style>
</head>
<body >  

<?php


$nameErr = $emailErr = $conpassErr =$passErr=$agreeErr= "";
$name = $email = $pass= $conpass="" ;

if(isset($_POST['submit'])){
$check=1;

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
    $check=0;
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
      $check=0;
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
    $check=0;
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      $check=0;
    }
  }
    

  if (empty($_POST["pass"])) {
    $passErr = "Password  is required";
    $check=0;
  } 

  if(strlen($_POST['pass']) < 6) {
    $passErr = "Password must be minimum of 6 characters";
    $check=0;
}       
if(strlen($_POST['pass']) > 16) {
  $passErr = "Password must be maximun of 15 characters";
  $check=0;
}   
if($_POST['pass'] != $_POST['conpass']) {
    $conpassErr = "Password and Confirm Password doesn't match";
    $check=0;
}

if(empty($_POST["agree"])) {
  $agreeErr = "Please check the check box";
  $check=0;
}    

if($check==1){
   
   
require("connect.php");


$q="insert into signup(name,email,Password ,Confirmpass) values('".$_POST['name']."','".$_POST['email']."','".$_POST['pass']."','".$_POST['conpass']."')";
$n=mysqli_query($con,$q);
if(!$n){
    echo '<script>alert("Record insertion failed")</script>';
    }
   
echo '<script>alert("Sign up Successfull");window.location.href = "index.php";</script>';
}
}
}
?>

<h2>Sign Up</h2>

<form method="post" action="" style="border:2px;left-margin:200px">  
<p><span class="error">* required field</span></p>
<i class="fa fa-user"></i><input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  <i class="fa fa-paper-plane"> <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>

  <i class="fa fa-lock"> <input type="password" name="pass" value="<?php echo $pass;?>">
  <span class="error">* <?php echo $passErr;?></span>
  <br><br>
   <i class="fa fa-lock"></i>
              <i class="fa fa-check"></i>
  <input type="password" name="conpass" value="<?php echo $conpass;?>">
  <span class="error"> <?php echo $conpassErr;?></span>
  <br><br>
  <input type="checkbox" name="agree" value="checked" />I agree the term of use & Privacy Policy<br />
  <span class="error"> <?php echo $agreeErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>



</body>
</html>
