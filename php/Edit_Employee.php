<?php
    require 'conn.php';
	session_start();
	
	if($_SESSION['Access']=="Admin")
	{
	$UserRowID=$_POST['UserRowID'];
    $Employee_ID=$_POST['Employee_ID'];
    $First_Name=$_POST['First_Name'];
    $Last_Name=$_POST['Last_Name'];
    $Access=$_POST['Access'];
	$Employee_Salary=$_POST['Employee_Salary'];
	$Employee_Salary_Currency=$_POST['Employee_Salary_Currency'];
    $Password=$_POST['Password'];
	

	$sql="UPDATE users SET Employee_ID='$Employee_ID',
	First_Name='$First_Name',
	Last_Name='$Last_Name',
	Access='$Access',
	Password='$Password',
	Employee_Salary='$Employee_Salary',
	Employee_Salary_Currency='$Employee_Salary_Currency' WHERE ID='$UserRowID'"; 
	$stmt = $conn->query($sql);
    if($stmt) {
        header('location: ../Employee_Managment.php?Message=User Updated Successfully !!!');
    }
    else
    {
        echo "Error";
    }
		
	}
	else if($_SESSION['Access']=="User")
	{
	$UserRowID=$_POST['UserRowID'];
    $First_Name=$_POST['First_Name'];
    $Last_Name=$_POST['Last_Name'];
    $Password=$_POST['Password'];
	

	$sql="UPDATE users SET First_Name='$First_Name',
	Last_Name='$Last_Name',
	Password='$Password' WHERE ID='$UserRowID'"; 
	$stmt = $conn->query($sql);
    if($stmt) {
        header('location: ../Employee_Managment.php?Message=User Updated Successfully !!!');
    }
    else
    {
        echo "Error";
    }
		
	}
    ?>