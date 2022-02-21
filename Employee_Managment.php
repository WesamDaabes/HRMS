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
      echo '<a href="MyRequests.php">My Requests</a>';
  }
  if ($_SESSION['Access']=="Admin") {
      echo '<a style="background-color:#E87521;" href="Employee_Managment.php">Employee Management</a>';
  }
  if ($_SESSION['Access']!="Admin") {
      echo '<a style="background-color:#E87521;" href="Employee_Managment.php">Edit My Info</a>';
  }
  ?>
  <a href="php/logout.php" class="right">Logout</a>
</div>

<div class="row">
<?php
if($_SESSION['Access']=="Admin")
	{
?>
  <div class="side">
    <h2>Please Choose A User To Edit:</h2>
    <style>
       table {
        border-collapse: collapse;
        width: 100%;
		text-align:center;
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
	white-space:nowrap;
    text-align: center;
    background-color: #E87521;
    color: white;
    }
	.EditBTN {
		background-color: #E87521;
		border: none;
		height:30px;
		width:75px;
		color: white;
		text-align: center;
		font-size: 16px;
		cursor: pointer;
	}

	.EditBTN:hover {
		opacity:60%;
		color: black;
		}
	.DeleteBTN {
		background-color: red;
		border: none;
		height:30px;
		width:75px;
		color: white;
		text-align: center;
		font-size: 16px;
		cursor: pointer;
	}

	.DeleteBTN:hover {
		opacity:60%;
		color: black;
		}
		
    </style>
  <script>
  function LoadUser(UserRowID)
  {
	  if (window.XMLHttpRequest)
	  {
		  xmlhttp=new XMLHttpRequest();
		  }
	  xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		  {
			  document.getElementById("Load_User_DIV").innerHTML=xmlhttp.responseText;
		  }
	  }
	 xmlhttp.open("GET","php/Load_User_To_DIV.php?UserRowID="+UserRowID,true);
	 xmlhttp.send();
  }
  </script>
    <?php
    require 'php/conn.php';
    $Employee_ID=$_SESSION['Employee_ID'];  
	$sql="SELECT * FROM users Order BY Employee_ID ASC"; 
	$stmt = $conn->query($sql);
    echo"<table>";
    echo"<tr class='firstrow'><td>Employee ID</td><td>Name</td><td>Edit</td><td>Delete</td></tr>";
 	while($row = $stmt->fetch_assoc()) {
		$Employee_ID= $row['Employee_ID'];
		$First_Name = $row['First_Name'];
		$Last_Name = $row['Last_Name'];
		$Access= $row['Access'];
		$ROW_ID= $row['ID'];

        echo"<tr><td>".$Employee_ID."</td><td>".$First_Name." ".$Last_Name."</td><td style='text-align:center;'><button class='EditBTN' onclick='LoadUser(".$ROW_ID.");'>Edit</button></td><td style='text-align:center;'><button class='DeleteBTN' onclick='window.location=\"php/DeleteUser.php?ROW_ID=".$ROW_ID."\"'>Delete</button></td></tr>";
		}
		
        echo"</table>";
    ?>
  </div>
	<?php } else {?>
	<div class="side">
    <h2>Your Info:</h2>
    <style>
       table {
        border-collapse: collapse;
        width: 100%;
		text-align: center;
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
	text-align: center;
	white-space:nowrap;
    background-color: #E87521;
    color: white;
    }
	.EditBTN {
		background-color: #E87521;
		border: none;
		height:30px;
		width:120px;
		color: white;
		text-align: center;
		font-size: 16px;
		cursor: pointer;
	}

	.EditBTN:hover {
		opacity:60%;
		color: black;
		}
	.DeleteBTN {
		background-color: red;
		border: none;
		height:30px;
		width:120px;
		color: white;
		text-align: center;
		font-size: 16px;
		cursor: pointer;
	}

	.DeleteBTN:hover {
		opacity:60%;
		color: black;
		}
		
    </style>
  <script>
  function LoadUser(UserRowID)
  {
	  if (window.XMLHttpRequest)
	  {
		  xmlhttp=new XMLHttpRequest();
		  }
	  xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		  {
			  document.getElementById("Load_User_DIV").innerHTML=xmlhttp.responseText;
		  }
	  }
	 xmlhttp.open("GET","php/Load_User_To_DIV.php?UserRowID="+UserRowID,true);
	 xmlhttp.send();
  }
  </script>
    <?php
    require 'php/conn.php';
    $Employee_ID=$_SESSION['Employee_ID'];  
	$sql="SELECT * FROM users WHERE Employee_ID='$Employee_ID' Order BY Employee_ID ASC"; 
	$stmt = $conn->query($sql);
    echo"<table>";
    echo"<tr class='firstrow'><td>Employee ID</td><td>Name</td><td>Salary</td><td>Access</td></tr>";
 	while($row = $stmt->fetch_assoc()) {
		$Employee_ID= $row['Employee_ID'];
		$First_Name = $row['First_Name'];
		$Last_Name = $row['Last_Name'];
		$Access= $row['Access'];
		$ROW_ID= $row['ID'];
		$Employee_Salary= $row['Employee_Salary'];
		$Employee_Salary_Currency= $row['Employee_Salary_Currency'];

        echo"<tr><td>".$Employee_ID."</td><td>".$First_Name." ".$Last_Name."</td><td>".$Employee_Salary." ".$Employee_Salary_Currency."</td><td>".$Access."</td></tr>";
		}
 


        echo"</table>";
		echo"<script>LoadUser(".$ROW_ID.");</script>";
    ?>
  </div>
	<?php } ?>
  <div id="Load_User_DIV" class="main">
  <?php
  if(isset($_GET['Message']))
  {
	  echo '<h2 style="color:green;">'.$_GET['Message'].'</h2>';
  }
  ?>
  </div>
  <script>
	function PWD(CHK)
	{
		if(CHK=="Disabled")
		{
		document.getElementById('PWD_CHK').value="Enabled";
		document.getElementById('Password').readOnly=false;
		}
		if(CHK=="Enabled")
		{
		document.getElementById('PWD_CHK').value="Disabled";
		document.getElementById('Password').readOnly=true;
		}
	}
	</script>
 

</form>
</div>
<div class="footer">
  <h4>Philadephia Uninversity Human Resourses Managment Project</h4>
  <input  class="WebpageButton" type="button" onclick="location.href='https://www.philadelphia.edu.jo';" value="Go To University Webpage" />
</div>

</body>
</html>
