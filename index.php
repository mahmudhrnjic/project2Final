<?php

   require '../PHPMailer-master/PHPMailerAutoload.php';
   $con = mysqli_connect("localhost", "root", "") or die("unable");

   mysqli_select_db($con, "project1_database");
   $email="";

   if (isset($_POST["submit"])) {
    # code...
   
   $name=$_POST["Name"];
   $email=$_POST["Email"];
   $question=$_POST["Question"];
   $subject="Question from project 1 webpage";

   $connection = "INSERT  INTO base (Name, Email, Question) VALUES ('$name', '$email','$question')";
   $connection2 = mysqli_query ($con, $connection);  
   
    $mail = new PHPMailer();
    $mail ->IsSmtp();
     $mail ->SMTPDebug = 0;
     $mail ->SMTPAuth = true;
     $mail ->SMTPSecure = 'ssl';
     $mail ->Host = "smtp.gmail.com";
     $mail ->Port = 465; // or 587
     $mail ->IsHTML(true);
     $mail ->Username = "mahmudmaho@gmail.com";
     $mail ->Password = "";
     $mail ->SetFrom("mahmudmaho@gmail.com");
     $mail ->Subject = $subject;
     $mail ->Body = $name. " asked you the following question: " .$question. ".  E-mail adress is: " .$email;
     $mail ->AddAddress("mahmudhrnjic@gmail.com");

  
   }
      if (filter_var($email, FILTER_VALIDATE_EMAIL, $_POST)) {
     $mail->Send();
     $emailError="";
    
    }
    else if($_POST)
    {
    $emailError="invalid e-mail";
    }
    
    
?>



<!DOCTYPE html>
<html lang="eng">
<head>
<title>E-cars</title>
<link rel="stylesheet" href="styleForForm.css">
<meta charset="utf-8">

</head>
<body>

<div class="form-style-6">
<h1>Contact Us</h1>
<form method="POST">
<input type="text" name="Name" placeholder="Your Name" />
<input type="text" name="Email" placeholder="Email Address" />
<span class="error"><?php 
if (filter_var($email, FILTER_VALIDATE_EMAIL, $_POST)) {
     $mail->Send();
    
    }
    else if($_POST)
    {
    $emailError="invalid e-mail";
    echo $emailError;
    }?></span>
  <br><br>
<textarea type="text" name="Question" placeholder="Type your Message"></textarea>
<input type="submit" name="submit" value="Send" />
</form>
</div>

<a href="index.html"><p id="backButton">Back to home</p></a>
</body>
</html>

