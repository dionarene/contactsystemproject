<?php

session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<ul class="nav nav-pills">
  <li role="presentation" class="active"><a href="#">Contact</a></li>
  <li role="presentation"><a href="managecontact.php">Manage Contact</a></li>
  <li role="presentation" style="float:right;"><a href="logout.php">Logout</a></li>
</ul>
<div class="wrapper">
    <h2>Welcome</h2>
    <a href="managecontact.php" style=" text-align: right;"><p>Add Contact</p></a>
    


<?php 
$username = "root"; 
$password = ""; 
$database = "session_example_database"; 
$mysqli = new mysqli("localhost", $username, $password, $database); 
$query = "SELECT * FROM contact";
 
 
echo '<table border="3" cellspacing="40" cellpadding="10"> 
      <tr> 
          <td> <font size="5" face="Arial">NAME</font> </td> 
          <td> <font size="5" face="Arial">COMPANY</font> </td> 
          <td> <font size="5" face="Arial">PHONE</font> </td> 
          <td> <font size="5" face="Arial">EMAIL</font> </td> 
          <td> <font size="5" face="Arial">MANAGE</font> </td> 
      </tr>';
 
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $company = $row["company"];
        $phone = $row["phone"];
        $email = $row["email"];
        // $field5name = $row["col5"]; 
 
        echo '<tr> 
                  <td><font size="3">'.$name.'</font></td> 
                  <td><font size="3">'.$company.'</font></td> 
                  <td><font size="3">'.$phone.'</font></td> 
                  <td><font size="3">'.$email.'</font></td> 
                  <td><font size="3"><a href="#">Edit</a> | <a>delete</a></font></td> 
              </tr>';
    }
    $result->free();
} 
?>


</div>
</body>
</html>