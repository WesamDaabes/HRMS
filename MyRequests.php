<?php
session_start();
if($_SESSION['Status']!="Active")
{
    header('location:index.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Requests</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
::-webkit-scrollbar {
    width: 0px;
    background: transparent; /* make scrollbar transparent */
}
.header {
  padding: 20px;
  text-align: center;
  background: #E87521;
  color: white;
}
.header h1 {
  font-size: 40px;
}
.navbar {
  overflow: hidden;
  background-color: #333;
   opacity:95%;
}
.navbar a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 14px 20px;
  text-decoration: none;
}
.navbar a.right {
  float: right;
}
.navbar a:hover {
  background-color: #ddd;
  color: black;
}
.row {  
  display: flex;
  flex-wrap: wrap;
}
.side {
  flex: 30%;
  background-color: #f1f1f1;
  padding: 20px;
}
.main {   
  flex: 70%;
  background-color: white;
  padding: 20px;
}
.fakeimg {
  background-color: #aaa;
  width: 100%;
  padding: 20px;
}
.footer {
  padding: 5px;
  text-align: center;
  background: #ddd;
  background-color: #efefef;
  flex: 0 0 50px;
  margin-top: auto;
  
}
@media screen and (max-width: 700px) {
  .row {   
    flex-direction: column;
  }
}
@media screen and (max-width: 400px) {
  .navbar a {
    float: none;
    width:100%;
  }
}
.WebpageButton {
    background-color: transparent;
    background-repeat: no-repeat;
    border: none;
    cursor: pointer;
    overflow: hidden;
    outline: none;
  }
</style>
</head>
<body>

<div class="header">
  <img src="images/logo.png" style="height: auto;position: absolute;margin-left: -58%;width: 27%;margin-top: -3%;"   class="left"  ><h1 style="margin-left:-30%;margin-top:2.7%;">Human Resources Managment System</h1><h1 style="color:transparent;margin-top:-4%;margin-left:150%;overflow:hidden;">.</h1>
  <p style="margin-left:80%;margin-top:-4.8%;position:absolute;"><?php echo "Hello " . $_SESSION['First_Name'] . " " . $_SESSION['Last_Name'] . " / " . $_SESSION['Employee_ID'] ; ?></p>
</div>

<div class="navbar">
  <a href="Homepage.php">Home</a>
  <?php
  if ($_SESSION['Access']=="Admin") {
      echo '<a href="AddEmployee.php">Add New Employee</a>';
  }
  ?>
  <a href="Requests.php">Requests</a>
  <?php
  if ($_SESSION['Access']!="Admin") {
      echo '<a style="background-color:#E87521;" href="MyRequests.php">My Requests</a>';
  }
  if ($_SESSION['Access']=="Admin") {
      echo '<a href="Employee_Managment.php">Employee Management</a>';
  }
  if ($_SESSION['Access']!="Admin") {
      echo '<a href="Employee_Managment.php">Edit My Info</a>';
  }
  ?>
  <a href="php/logout.php" class="right">Logout</a>
</div>
  <div class="main">
    <h2>Vacations</h2>
    <style>
       table {
        border-collapse: collapse;
        width: 100%;
        }

    td {
    border: 1px solid #ddd;
    padding: 8px;
    }

    tr:nth-child(even){background-color: #fff;}

    tr:hover {background-color: #ddd;}

    .firstrow {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #E87521;
    color: white;
    }
    </style>
    <?php
    require 'php/conn.php';
    $Employee_ID=$_SESSION['Employee_ID'];   
	$sql="SELECT * FROM requests WHERE Requester_ID='$Employee_ID' AND Request_Type='Vacation'"; 
	$stmt = $conn->query($sql);
    echo"<table>";
    echo"<tr class='firstrow'><td>ID</td><td>Name</td><td>From Date</td><td>To Date</td><td>Status</td></tr>";
 	while($row = $stmt->fetch_assoc()) {
		$Requester_ID= $row['Requester_ID'];
		$Requester_Name = $row['Requester_Name'];
		$Request_Status=$row['Request_Status'];
		$From_Date=$row['From_Date'];
		$To_Date=$row['To_Date'];
		$ROW_ID= $row['ID'];

        echo"<tr><td>".$Requester_ID."</td><td>".$Requester_Name."</td><td>".$From_Date."</td><td>".$To_Date."</td><td>".$Request_Status."</td></tr>";
		}
        echo"</table>";
	?>	
	<h2>Leaves</h2>
	<?php
	$sql1="SELECT * FROM requests WHERE Requester_ID='$Employee_ID' AND Request_Type='Leave'"; 
	$stmt1 = $conn->query($sql1);
    echo"<table>";
    echo"<tr class='firstrow'><td>ID</td><td>Name</td><td>Date</td><td>From Time</td><td>To Time</td><td>Status</td></tr>";
 	while($row1 = $stmt1->fetch_assoc()) {
		$Requester_ID= $row1['Requester_ID'];
		$Requester_Name = $row1['Requester_Name'];
    $Request_Status=$row1['Request_Status'];
    $From_Date=$row1['From_Date'];
    $From_Time=$row1['From_Time'];
    $To_Time=$row1['To_Time'];
    $ROW_ID= $row1['ID'];

        echo"<tr><td>".$Requester_ID."</td><td>".$Requester_Name."</td><td>".$From_Date."</td><td>".$From_Time."</td><td>".$To_Time."</td><td>".$Request_Status."</td></tr>";
		}
        echo"</table>";
    ?>
  </div>

<div class="footer">
  <h4>Philadephia Uninversity Human Resourses Managment Project</h4>
  <input  class="WebpageButton" type="button" onclick="location.href='https://www.philadelphia.edu.jo';" value="Go To University Webpage" />
</div>
</body>
</html>
