<?php
  session_start(); 
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use  PHPMailer\PHPMailer\PHPMailer;
use  PHPMailer\PHPMailer\SMTP;
use  PHPMailer\PHPMailer\Exception;

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'project1');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail-> Host="smtp.gmail.com";
  $mail->SMTPAuth="true";
  $mail->SMTPSecure="tls";
  $mail->Port="587";
  $mail->Username="teamoquiz@gmail.com";
  $mail->Password="Oquiz@123";
  $mail->Subject="Congratualations for Sign in";
  $mail->setFrom("teamoquiz@gmail.com");
  $mail->isHTML(true);
  $mail->addAttachment('symbol.jpeg');
  $mail->Body="<h1> Testing </h1></br><p> Hello $username Welcome. Congratualations for entering to OQUIZ.</br>
  <h2>
  Username:$username;<br></br>
  Registered Mail:$email;<br></br>
  Password:$password_1;<br></br>
  </h2>
  
  Regards:TeamOquiz
  </p> ";
  $mail->addAddress($email);
  
  if ($mail->Send()){
      echo "Sucess....";
  
  }else{
      echo "Bela";
  }
  $mail->smtpClose();
  
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = ($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
    $_SESSION['email']=$email;
  	$_SESSION['success'] = "You are now logged in";
    header('location: login.php');
  }
}


// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = ($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: start2.html');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}
?>