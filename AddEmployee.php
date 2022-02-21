<?php
session_start();
if($_SESSION['Status']!="Active")
{
    header('location:index.html');
    exit;
}
if($_SESSION['Access']!="Admin")
{
    header('location:Homepage.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add New Employee</title>
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
      echo '<a style="background-color:#E87521;" href="AddEmployee.php">Add New Employee</a>';
  }
  ?>
  <a href="Requests.php">Requests</a>
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
    <h2>Employee List</h2>
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
	$sql="SELECT * FROM users WHERE Employee_ID!='$Employee_ID' Order BY Employee_ID ASC"; 
	$stmt = $conn->query($sql);
    echo"<table>";
    echo"<tr class='firstrow'><td>Employee ID</td><td>Name</td><td>Access</td></tr>";
 	while($row = $stmt->fetch_assoc()) {
		$Employee_ID= $row['Employee_ID'];
		$First_Name = $row['First_Name'];
		$Last_Name = $row['Last_Name'];
		$Access= $row['Access'];

        echo"<tr><td>".$Employee_ID."</td><td>".$First_Name." ".$Last_Name."</td><td>".$Access."</td></tr>";
		}
        echo"</table>";
    ?>
  </div>
  <div class="main">
    <h2>Add New Employee</h2>
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
    <form action="php/Add_New_Employee.php" method="post">
    <div class="container">
      <label for="Employee_ID"><b>Employee ID</b></label>
      <input type="number" placeholder="Enter Employee ID" name="Employee_ID" required>
      <label for="First_Name"><b>First Name</b></label>
      <input type="text" placeholder="Enter First Name" name="First_Name" required>
      <label for="Last_Name"><b>Last Name</b></label>
      <input type="text" placeholder="Enter Last Name" name="Last_Name" required>
      <label for="Access"><b>Access</b></label>
      <select name="Access" required>
        <option selected value="User">User</option>
        <option value="Admin">Admin</option>
      </select>
	  <label for="Salary"><b>Salary</b></label>
      <input type="number" step="0.01" placeholder="Enter Salary" name="Employee_Salary" required>
	  <label for="Employee_Salary_Currency"><b>Salary Currency</b></label>
      <select name="Employee_Salary_Currency" required>
        <option selected value="JOD">JOD</option>
		<option value="USD">USD</option>
		<option value="EUR">EUR</option>
      </select>
      <script>
$('#dob').datepicker({
    onSelect: function(value, ui) {
        var today = new Date(),
            dob = new Date(value),
            age = new Date(today - dob).getFullYear() - 1970;

        $('#age').text(age);
    },
    maxDate: '+0d',
    yearRange: '1920:2010',
    changeMonth: true,
    changeYear: true
});
      </script>
      <label for="Password"><b>Password</b></label>
      <input id ="pass1" type="password" placeholder="Enter Password" name="Password" onkeyup="check" required>
      <label for="Password"><b>con Password </b></label>
      <input id ="pass" type="password" placeholder="Enter con Password" name="Password" onkeyup="check" required>
      <span id="massege"></span>


      <input type="submit" value="Submit">
    </div>
  </form>
  </div>
</div>
<div class="footer">
  <h4>Philadephia Uninversity Human Resourses Managment Project</h4>
  <input  class="WebpageButton" type="button" onclick="location.href='https://www.philadelphia.edu.jo';" value="Go To University Webpage" />
</div>

<script>
var check =function(){
  if (document.getElementById("pass1").value==document.getElementById("pass").value){
document.getElementById("massege").style.color ='green';
document.getElementById('massege').innerHTML ="matching";

  }

}
</script>
</body>
</html>
