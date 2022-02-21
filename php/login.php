<?php
session_start();
if (isset($_POST['Employee_ID']) && $_POST['Password'] != "") {

	$Employee_ID=$_POST["Employee_ID"];
	$Password=$_POST["Password"];
	
    require 'conn.php';       
	
	$sql="SELECT * FROM users WHERE Employee_ID ='$Employee_ID' and Password='$Password'"; 
	$stmt = $conn->query($sql);
 	while($row = $stmt->fetch_assoc()) {
		$_SESSION['Employee_ID'] = $row['Employee_ID'];
		$_SESSION['First_Name'] = $row['First_Name'];
		$_SESSION['Last_Name'] = $row['Last_Name'];
		$_SESSION['Access']= $row['Access'];
        $_SESSION['Status']='Active';
		header('location:../Homepage.php');
		}
		echo 'Wrong Username or Password !';
}

        
?>