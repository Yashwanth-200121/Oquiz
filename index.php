<?php 
session_start();
    include("connection.php");
    include("function.php");
    $user_data = check_login($con);
?>
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<!---<div class="header">
	<h2>Home Page</h2>
</div>
	Welcome to my project page	
<div class="content">--->
  	
<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) :
	require 'server.php';

		$u=$_SESSION['username'];
		$m="SELECT EMAIL FROM USERS WHERE USERNAME='$u'";
		$result = $db->query($m);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc())
  {
      $na=$row['EMAIL'];
  }}?>


 <center>
 <img src="sign.png" alt="Italian Trulli" style="width:15%;">
</center>
   <p> Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
   <p> Welcome <strong><?php echo "$na"; ?></strong></p>
   <p> <a href="quiz.html" style="color:green;">Quiz</a> </p>
   <p> <a href="quiz3.html" style="color:green;">Quiz3</a> </p>
   <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>


    <?php endif ?>

    
</div>

</body>
</html>