<?php
    session_start();
    require 'conn.php'; 
    $Date=$_POST['Date'];
    $From_Time=$_POST['From_Time'];
    $To_Time=$_POST['To_Time'];
    $Request_Type="Leave";
    $Requester_ID=$_SESSION['Employee_ID'];
    $Requester_Name=$_SESSION['First_Name'] ." ". $_SESSION['Last_Name'] ;
    $Request_Status="Pending";

	$sql="INSERT INTO requests (Requester_ID,Requester_Name,Request_Type,From_Date,From_Time,To_Time,Request_Status) VALUES ('$Requester_ID','$Requester_Name','$Request_Type','$Date','$From_Time','$To_Time','$Request_Status')"; 
	$stmt = $conn->query($sql);
    if($stmt) {
        header('location: http://localhost/HRMS/Requests.php?Status=1');
    }
    else
    {
        header('location: http://localhost/HRMS/Requests.php?Status=2');
    }
    ?>