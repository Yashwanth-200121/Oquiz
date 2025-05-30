<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forgot Password</title>
  <link rel=stylesheet href=style.css>
</head>

<body>

<div id="i3">
  <div class="header">
  	<h2>Forgot Password</h2>
  </div>
  <form method="GET" action="forgotpass.php">
    <div class="input-group">
  	  <label>Registered Email</label>
  	  <input type="text" name="email" >
        <input   type="submit">
        
  	</div>
   </form>
<?php
   require 'server.php';
    $k=$_GET['email'];
		$u=$_SESSION['username'];
		$m="SELECT PASSWORD FROM USERS WHERE EMAIL='$k'";
		$result = $db->query($m);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc())
  {
      $na=$row['PASSWORD'];
  }}

echo "<script> alert ('$na')</script>";



