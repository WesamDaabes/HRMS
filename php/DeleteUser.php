<?php
	$ROW_ID=$_GET['ROW_ID'];
    require 'conn.php'; 

	$sql="DELETE FROM users WHERE ID='$ROW_ID'"; 
	$stmt = $conn->query($sql);
    if($stmt) {
        header('location: ../Employee_Managment.php?Message=User Deleted Successfully !!!');
    }
    else
    {
        echo "Error";
    }
    ?>