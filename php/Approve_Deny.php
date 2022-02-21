<?php
    require 'conn.php'; 
    $Action=$_POST['Action'];
    $ROW_ID=$_POST['ROW_ID'];

	$sql="UPDATE requests SET Request_Status='$Action' WHERE ID='$ROW_ID'"; 
	$stmt = $conn->query($sql);
    if($stmt) {
        header('location: ../Requests.php');
    }
    else
    {
        header('location: ../Requests.php');
    }
    ?>