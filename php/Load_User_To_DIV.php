<?php
    session_start();
	$UserRowID=$_GET['UserRowID'];
	
    require 'conn.php';

	$sql="SELECT * FROM users WHERE ID='$UserRowID'"; 
	$stmt = $conn->query($sql);
 	while($row = $stmt->fetch_assoc()) {
		$Employee_ID= $row['Employee_ID'];
		$Password = $row['Password'];
		$Access = $row['Access'];
		$First_Name= $row['First_Name'];
		$Last_Name= $row['Last_Name'];
		$Employee_Salary= $row['Employee_Salary'];
		$Employee_Salary_Currency= $row['Employee_Salary_Currency'];
	}
    ?>
<h2>Edit Employee Information</h2>
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
    <form action="php/Edit_Employee.php" method="post">
	<input type="hidden" name="UserRowID" value="<?php echo $UserRowID;?>" required>
    <div class="container">
	<?php if($_SESSION['Access']=="Admin") { ?>
      <label for="Employee_ID"><b>Employee ID</b></label>
      <input type="number" placeholder="Enter Employee ID" name="Employee_ID" value="<?php echo $Employee_ID;?>" required>
	<?php } ?>
      <label for="First_Name"><b>First Name</b></label>
      <input type="text" placeholder="Enter First Name" name="First_Name" value="<?php echo $First_Name;?>" required>
      <label for="Last_Name"><b>Last Name</b></label>
      <input type="text" placeholder="Enter Last Name" name="Last_Name" value="<?php echo $Last_Name;?>" required>
	  <?php if($_SESSION['Access']=="Admin") { ?>
      <label for="Access"><b>Access</b></label>
      <select name="Access" required>
		<option selected value="<?php echo $Access;?>"><?php echo $Access;?></option>
		<?php 
		if($Access=="Admin")
		{
			echo'<option value="User">User</option>';
		}
		if($Access=="User")
		{
			echo'<option value="Admin">Admin</option>';
		}
		?>
      </select>
	  <label for="Salary"><b>Salary</b></label>
      <input type="number" step="0.01" placeholder="Enter Salary" name="Employee_Salary" value="<?php echo $Employee_Salary;?>" required>
	  <label for="Employee_Salary_Currency"><b>Salary Currency</b></label>
      <select name="Employee_Salary_Currency" required>
	  <option selected value="<?php echo $Employee_Salary_Currency;?>"><?php echo $Employee_Salary_Currency;?></option>
		<?php 
		if($Employee_Salary_Currency=="JOD")
		{
			echo'<option value="USD">USD</option>
			<option value="EUR">EUR</option>';
		}
		if($Employee_Salary_Currency=="USD")
		{
			echo'<option value="JOD">JOD</option>
			<option value="EUR">EUR</option>';
		}
		if($Employee_Salary_Currency=="EUR")
		{
			echo'<option value="JOD">JOD</option>
			<option value="USD">USD</option>';
		}
		?>
      </select>
	  <?php }?>
      <label for="Password"><b>Password</b></label><input style="margin-left:1%;" type="checkbox" onclick="PWD(this.value);" id="PWD_CHK" name="PWD_CHK" value="Disabled">Enable Password Change
      <input readonly type="password" placeholder="Enter Password" id="Password" name="Password" value="<?php echo $Password;?>" required>
      <input type="submit" value="Submit">
    </div>
  </form>