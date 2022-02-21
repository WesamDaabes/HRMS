<?php
    session_start();
    require 'conn.php'; 
    $From_Date=$_POST['From_Date'];
    $To_Date=$_POST['To_Date'];
    $Request_Type="Vacation";
    $Requester_ID=$_SESSION['Employee_ID'];
    $Requester_Name=$_SESSION['First_Name'] ." ". $_SESSION['Last_Name'] ;
    $Request_Status="Pending";

	$sql="INSERT INTO requests (Requester_ID,Requester_Name,Request_Type,From_Date,To_Date,Request_Status) VALUES ('$Requester_ID','$Requester_Name','$Request_Type','$From_Date','$To_Date','$Request_Status')"; 
	$stmt = $conn->query($sql);
    if($stmt) {
        header('location: http://localhost/HRMS/Requests.php?Status=1');
    }
    else
    {
        header('location: http://localhost/HRMS/Requests.php?Status=2');
    }
    ?>