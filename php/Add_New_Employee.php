<?php
    require 'conn.php'; 

    $Employee_ID=$_POST['Employee_ID'];
    $First_Name=$_POST['First_Name'];
    $Last_Name=$_POST['Last_Name'];
    $Access=$_POST['Access'];
	$Employee_Salary=$_POST['Employee_Salary'];
	$Employee_Salary_Currency=$_POST['Employee_Salary_Currency'];
    $Password=$_POST['Password'];
	

	$sql="INSERT INTO users (Employee_ID,First_Name,Last_Name,Access,Password,Employee_Salary,Employee_Salary_Currency) VALUES ('$Employee_ID','$First_Name','$Last_Name','$Access','$Password','$Employee_Salary','$Employee_Salary_Currency')"; 
	$stmt = $conn->query($sql);
    if($stmt) {
        header('location: ../AddEmployee.php');
    }
    else
    {
        echo "Error";
    }
    ?>