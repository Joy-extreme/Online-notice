<?php
extract($_POST);

if(isset($save))
{

	if($e=="" || $p=="")
	{
	  $err="<font color='red'>fill all the fields</font>";
	}
	else
	{ 
		$pass=md5($p);

		$sql=mysqli_query($conn,"select * from user where email='$e' and pass='$pass'");

		$r=mysqli_num_rows($sql);
		$fetch=mysqli_fetch_assoc($sql);

		if($r==true)
		{
			if($fetch['verifyStatus'] == 1)
			{
				$_SESSION['user']=$e;
				if($fetch['designation'] == 'Student')
				{
					header('location:user/index.php');
				}

				else if($fetch['designation'] == 'admin')
				{
					header('location:admin/index.php');
				}
				else
				{
					header('location:teacher/index.php');

				}


				// $_SESSION['user']=$e;

			    // header('location:teacher/index.php');

			}
			else
			{
				$err="<font color='red'>Email is not verified</font>";
			}
			

		}

		else
		{

			$err="<font color='red'>Invalid login details</font>";

		}
    } 
}

?>
<h2><b>LOGIN FORM</B></h2>
<form method="post">

	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4"><?php echo @$err;?></div>
	</div>



	<div class="row">
		<div class="col-sm-4">Email ID</div>
		<div class="col-sm-5">
		<input type="email" name="e" class="form-control" required/></div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Password</div>
		<div class="col-sm-5">
		<input type="password" name="p" class="form-control" required/></div>
	</div>
	<div class="row" style="margin-top:10px">
		<div class="col-sm-0"></div>
		<div class="col-sm-5">
		<input type="submit" value="Login" name="save" class="btn btn-success"/>

		</div>
	</div>
</form>
