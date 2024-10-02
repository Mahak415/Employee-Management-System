<?php
include("connection.php")
?>

<?php
if(isset($_POST['searchdata']))
{
	$search = $_POST['id'];

	$query = "SELECT * FROM form WHERE ID ='$search'" ;

	$data = mysqli_query($conn, $query);

	$result = mysqli_fetch_assoc($data);
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Employee Management</title>
	<link rel="stylesheet"  href="style.css">
</head>
<body>
	<div class="center">
		<form action="#" method="POST">
		<h1>Employee Data Entry</h1>
		<div class="form">
			<input type="text" name="id" class="textfield" placeholder="Search ID" value="<?php
			if(isset($_POST['searchdata'])) 
			{
				echo $result['ID'];
			}

			 ?>">

			<input type="text" name="name" class="textfield" placeholder="Employee Name" value="<?php
			if(isset($_POST['searchdata'])) 
			{
				echo $result['emp_name'];
			}

			 ?>">

			<select class="textfield" name="gender">
				<option>Select Gender</option>
				<option value="Male"<?php 
				if(isset($_POST['searchdata']))
				{
				  if($result['emp_gender'] == 'Male')
					{
						echo "selected";
					}
				}
				?>
				>Male</option>
				<option value="Female"
				<?php 
				if(isset($_POST['searchdata']))
				{
				  if($result['emp_gender'] == 'Female')
					{
						echo "selected";
			        }
			    }
			    ?>
			    >Female</option>
				<option value="Other"
				<?php 
				if(isset($_POST['searchdata']))
				{
				  if($result['emp_gender'] == 'Other')
					{
						echo "selected";
			        }
			    }
			    ?>
			    >Other</option>
			</select>

			<input type="text" name="email" class="textfield" placeholder="Email Address"  value="<?php
			if(isset($_POST['searchdata'])) 
			{
				echo $result['emp_email'];
			}

			 ?>">

			<select class="textfield" name="department">
				<option>Select Department</option>

				<option value="IT"
				<?php 
				if(isset($_POST['searchdata']))
				{
				  if($result['emp_department'] == 'IT')
					{
						echo "selected"; 
			        }
			    }
			    ?>
			    >IT</option>

				<option value="HR"
				<?php 
				if(isset($_POST['searchdata']))
				{
				  if($result['emp_department'] == 'HR')
					{
						echo "selected";
			        }
			    }
			    ?>
			    >HR</option>

				<option value="Accounts"
				<?php 
				if(isset($_POST['searchdata']))
				{
				  if($result['emp_department'] == 'Accounts')
					{
						echo "selected";
			        }
			    }
			    ?>
			    >Accounts</option>

				<option value="Sales"
				<?php 
				if(isset($_POST['searchdata']))
				{
				  if($result['emp_department'] == 'Sales')
					{
						echo "selected";
			        }
			    }
			    ?>
			    >Sales</option>

				<option value="Marketing"
				<?php 
				if(isset($_POST['searchdata']))
				{
				  if($result['emp_department'] == 'Marketing')
					{
						echo "selected";
			        }
			    }
			    ?>
			    >Marketing</option>

				<option value="Business Development"
				<?php 
				if(isset($_POST['searchdata']))
				{
				  if($result['emp_department'] == 'Business Development')
					{
						echo "selected";
			        }
			    }
			    ?>>Business Development</option>

			</select>
			<textarea   placeholder="Address"  name="address"><?php if(isset($_POST['searchdata'])) { echo $result['emp_address'];}?></textarea>
			<input type="submit" name="searchdata" value="Search" class="btn" style="background-color: gray;">

			<input type="submit" name="save" value="Save" name="" class="btn" style="background-color: green;">

			<input type="submit" name="update" value="Modify" class="btn" style="background-color: orange;">

			<input type="submit"  name="Delete" value="Delete" class="btn" style="background-color: Red;">

			<input type="reset" name=""  value="Clear" class="btn" style="background-color: blue;">
		</div>
		</form>
	</div>
</body>
</html>


<?php
if(isset($_POST['save']))
{
	$name      =$_POST['name'];
	$gender    =$_POST['gender'];
	$email     =$_POST['email'];
	$department=$_POST['department'];
	$address   =$_POST['address'];
	if (!$_POST['name']|| !$_POST['email'] || !$_POST['address']) 
    {    
         
		echo "<script> alert('please fill all the fields') </script>";
    }
    else if (!in_array($gender, array("Male", "Female","Other")) || !in_array($department, array("IT", "HR", "Accounts","Sales", "Marketing", "Business Development")))
    {
    	echo "<script> alert('please fill all the fields') </script>";
    }
    else
    {
    	if(!ctype_alpha($name))
        {
    	    echo "<script> alert('Please enter valid name') </script>";
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
    	    echo "<script> alert('please enter valid email') </script>";
        }
        else
        {
	        $insert = "INSERT INTO form(emp_name,emp_gender,emp_email,emp_department,emp_address) VALUES('$name','$gender','$email','$department','$address')";
	        $data = mysqli_query($conn, $insert);
	        if($data)
	        {
		        echo "<script> alert('Data saved into database') </script>";
	        }
	        else
	        {
	    	    echo "<script> alert('Failed to save data into database') </script>";
	        }
	    }
	}
	
}
?>


<?php
if(isset($_POST['Delete']))
{
	$id = $_POST['id'];

	$query = "DELETE FROM form WHERE ID = '$id'";

	$data = mysqli_query($conn, $query);

	if ($data) {
		echo "<script> alert('Data deleted successfully') </script>";
	}
	else
	{
		echo "<script> alert('Failed to delete data') </script>";
	}
}

?>

<?php
if(isset($_POST['update']))
{
	$id        =$_POST['id'];
	$name      =$_POST['name'];
	$gender    =$_POST['gender'];
	$email     =$_POST['email'];
	$department=$_POST['department'];
	$address   =$_POST['address'];
	if (!$_POST['name'] || empty($_POST['gender']) || !$_POST['email'] || empty($_POST['department']) || empty($_POST['address'])) 
    {    
         echo "<script> alert('Please fill all the fields') </script>";
    }
    else if (!in_array($gender, array("Male", "Female","Other")) || !in_array($department, array("IT", "HR", "Accounts","Sales", "Marketing", "Business Development")))
    {
    	echo "<script> alert('please fill all the fields') </script>";
    }
    else
    {
    	if(!ctype_alpha($name))
        {
    	    echo "<script> alert('Please enter valid name') </script>";
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
    	    echo "<script> alert('please enter valid email') </script>";
        }
        else
        {
            $query="UPDATE form SET emp_name = '$name',emp_gender = '$gender',emp_email = '$email',emp_department = '$department',emp_address = '$address' WHERE ID = '$id'";

            $data = mysqli_query($conn, $query);

	        if ($data) 
	        {
		        echo "<script> alert('Record updated') </script>";
	        }
	        else
	        {
	    	    echo "<script> alert('Failed to update record') </script>";
	        }
	    }
	}
}

?>
