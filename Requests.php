<?php
session_start();
if($_SESSION['Status']!="Active")
{
    header('location:index.html');
    exit;
}
?>
<?php
if($_SESSION['Access']=="Admin")
{
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
  <a style="background-color:#E87521;" href="Requests.php">Requests</a>
  <?php
  if ($_SESSION['Access']!="Admin") {
      echo '<a href="MyRequests.php">My Requests</a>';
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

<div class="row">
  <div class="side">
    <h2>Requests List</h2>
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
	$sql="SELECT ID,Requester_ID,Requester_Name,Request_Type,Request_Status FROM requests WHERE Request_Status='Pending'"; 
	$stmt = $conn->query($sql);
    echo"<table>";
    echo"<tr class='firstrow'><td>ID</td><td>Name</td><td>Type</td><td>Status</td><td>View</td></tr>";
 	while($row = $stmt->fetch_assoc()) {
		$Requester_ID= $row['Requester_ID'];
		$Requester_Name = $row['Requester_Name'];
		$Request_Type= $row['Request_Type'];
    $Request_Status=$row['Request_Status'];
    $ROW_ID= $row['ID'];

        echo"<tr><td>".$Requester_ID."</td><td>".$Requester_Name."</td><td>".$Request_Type."</td><td>".$Request_Status."</td><td><a href='http://localhost/HRMS/Requests.php?ID=".$Requester_ID."&Type=".$Request_Type."&ROW_ID=".$ROW_ID."'>View</a></td></tr>";
		}
        echo"</table>";
    ?>
  </div>
  <div class="main">
    <h2>Request Info</h2>
    <style>
    input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    }
    input[type=password], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    }
    input[type=number], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    }
    input[type=date], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    }
    input[type=time], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    }
    input[type=submit] {
    width: 100%;
    background-color: #E87521;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

    input[type=submit]:hover {
    opacity: 80%;
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
  <?php if(isset($_GET['ROW_ID'])) {
    require 'php/conn.php'; 
    $ROW_ID=$_GET['ROW_ID'];
	  $sql="SELECT * FROM requests WHERE ID='$ROW_ID'"; 
	  $stmt = $conn->query($sql);
 	  while($row = $stmt->fetch_assoc()) {
		  $Requester_ID= $row['Requester_ID'];
		  $Requester_Name = $row['Requester_Name'];
      $Request_Type= $row['Request_Type'];
		  $From_Date= $row['From_Date'];
      $To_Date= $row['To_Date'];
      $From_Time= $row['From_Time'];
      $To_Time= $row['To_Time'];
      $ROW_ID= $row['ID'];
		}
    if($_GET['Type']=="Leave")
    {
      echo '<div class="container">
      <form action="php/Approve_Deny.php" method="post">
            <label for="Requester_ID"><b>Requester ID</b></label>
            <input readonly type="number" value="'.$Requester_ID.'" name="Requester_ID" required>
            <label for="Requester_Name"><b>Requester Name</b></label>
            <input readonly type="text" value="'.$Requester_Name.'" name="Requester_Name" required>
            <label for="Request_Type"><b>Request Type</b></label>
            <input readonly type="text" value="'.$Request_Type.'" name="Request_Type" required>
            <label for="From_Date"><b>Date</b></label>
            <input readonly type="date" value="'.$From_Date.'" name="From_Date" required>
            <label for="From_Time"><b>From Time</b></label>
            <input readonly type="time" value="'.$From_Time.'" name="From_Time" required>
            <label for="To_Time"><b>To Time</b></label>
            <input readonly type="time" value="'.$To_Time.'" name="To_Time" required>
            <label for="Action"><b>Action</b></label>
            <select name="Action" required>
            <option value="">Please Choose</option>
            <option value="Approve">Approve</option>
            <option value="Deny">Deny</option>
            </select>
            <input type="hidden" name="ROW_ID" value="'.$ROW_ID.'">
            <input type="submit" value="Submit">
            </form>
          </div>';
    }
    if($_GET['Type']=="Vacation")
    {
      echo '<div class="container">
      <form action="php/Approve_Deny.php" method="post">
            <label for="Requester_ID"><b>Requester ID</b></label>
            <input readonly type="number" value="'.$Requester_ID.'" name="Requester_ID" required>
            <label for="Requester_Name"><b>Requester Name</b></label>
            <input readonly type="text" value="'.$Requester_Name.'" name="Requester_Name" required>
            <label for="Request_Type"><b>Request Type</b></label>
            <input readonly type="text" value="'.$Request_Type.'" name="Request_Type" required>
            <label for="From_Date"><b>From Date</b></label>
            <input readonly type="date" value="'.$From_Date.'" name="From_Date" required>
            <label for="To_Date"><b>To Date</b></label>
            <input readonly type="date" value="'.$To_Date.'" name="To_Date" required>
            <label for="Action"><b>Action</b></label>
            <select name="Action" required>
            <option value="">Please Choose</option>
            <option value="Approve">Approve</option>
            <option value="Deny">Deny</option>
            </select>
            <input type="hidden" name="ROW_ID" value="'.$ROW_ID.'">
            <input type="submit" value="Submit">
            </form>
          </div>';
    }
  }
  ?>
  </div>
</div>

<div class="footer">
  <h4>Philadephia Uninversity Human Resourses Managment Project</h4>
  <input  class="WebpageButton" type="button" onclick="location.href='https://www.philadelphia.edu.jo';" value="Go To University Webpage" />
</div>

</body>
</html>
<?php } ?>
<!-- NOT ADMIN -->
<!-- NOT ADMIN -->
<!-- NOT ADMIN -->
<!-- NOT ADMIN -->
<!-- NOT ADMIN -->
<!-- NOT ADMIN -->
<!-- NOT ADMIN -->
<!-- NOT ADMIN -->
<!-- NOT ADMIN -->
<?php
if($_SESSION['Access']!="Admin")
{
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
  overflow:hidden; /* Hide Scrollbar */
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
  <a style="background-color:#E87521;" href="Requests.php">Requests</a>
  <?php
  if ($_SESSION['Access']!="Admin") {
      echo '<a href="MyRequests.php">My Requests</a>';
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
    <h2>Apply Request</h2>
    <style>
    input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    }
    input[type=password], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    }
    input[type=number], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    }
    input[type=date], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    }
    input[type=time], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    }

    input[type=submit] {
    width: 100%;
    background-color: #E87521;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

    input[type=submit]:hover {
    opacity: 80%;
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
    <?php if(isset($_GET['Status'])) {
      if($_GET['Status']==1)
      {
        echo "<label style='color:green;font-weight:bold;font-size:22px;'>Submitted Successfully !</label>";
      }
      if($_GET['Status']==2)
      {
        echo "<label style='color:red;font-weight:bold;font-size:22px;'>Error Occured Whilst Submitting !</label>";
      }
    }
    else
    {
      echo '<div class="container">
      <label for="Request_Type"><b>Select Request Type</b></label><br>
        <select id="Request_Type" name="Request_Type" required style="width:10%;" onchange="DivSelector();">
          <option selected value="Leave">Leave</option>
          <option value="Vacation">Vacation</option>
        </select>
      </div>';
    }
    ?>
    <div style="display:none;" id="Leave_DIV">
    <form action="php/Add_New_Leave.php" method="post">
    <div class="container">
      <label for="Date"><b> Date</b></label>
      <input type="date" value="<?php echo date("Y-m-d"); ?>" name="Date" required>
      <label for="From_Time"><b>From Time</b></label>
      <input type="time" name="From_Time" required>
      <label for="To_Time"><b>To Time</b></label>
      <input type="time" name="To_Time" required>
      <input type="submit" value="Submit">
    </div>
  </form>
    </div>
    <div style="display:none;" id="Vacation_DIV">
    <form action="php/Add_New_Vacation.php" method="post">
    <div class="container">
      <label for="From_Date" ><b>From Date</b></label>
      <input type="date" value="<?php echo date("Y-m-d"); ?>" name="From_Date" required>
      <label for="To_Date"><b>To Date</b></label>
      <input type="date" value="<?php echo date("Y-m-d"); ?>" name="To_Date" required>
      <input type="submit" value="Submit">
    </div>
  </form>
    </div>
  </form>
  </div>
</div>

<div class="footer">
  <h4>Philadephia Uninversity Human Resourses Managment Project</h4>
  <input  class="WebpageButton" type="button" onclick="location.href='https://www.philadelphia.edu.jo';" value="Go To University Webpage" />
</div>
<script>
  DivSelector();
function DivSelector() {
var DIV_Value = document.getElementById('Request_Type').value;
if(DIV_Value=="Leave")
{
  var DIV_ID = document.getElementById('Leave_DIV');
  DIV_ID.style.display="";
  var DIV_ID = document.getElementById('Vacation_DIV');
  DIV_ID.style.display="none";

}
else if(DIV_Value=="Vacation")
{
  var DIV_ID = document.getElementById('Leave_DIV');
  DIV_ID.style.display="none";
  var DIV_ID = document.getElementById('Vacation_DIV');
  DIV_ID.style.display="";
}
else if(DIV_Value=="")
{
  var DIV_ID = document.getElementById('Leave_DIV');
  DIV_ID.style.display="none";
  var DIV_ID = document.getElementById('Vacation_DIV');
  DIV_ID.style.display="none";
}
}
</script>
</body>
</html>
<?php } ?>
