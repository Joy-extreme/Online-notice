<?php 
extract($_POST);
if(isset($add))
{
	$filename=$_FILES['file']['name'];

	if(file_exists("../file/".$filename))
	{
	$err="<font color='red'>Change the name of the file</font>";	
	}
	else
	{
		$user= $_SESSION['user'];
		$sql=mysqli_query($conn,"select * from user where email='$user' ");
		$users=mysqli_fetch_assoc($sql);
		$name=$users['name'];
		$noticeIssuer=$users['designation'];

		move_uploaded_file($_FILES['file']['tmp_name'],"../file/".$_FILES['file']['name']);
		
		
		$userType="All";
        mysqli_query($conn,"insert into notice(`Description`,`noticeIssuer`,`userType`,`name`,`FileName`) values('$details','$noticeIssuer','$userType','$name','$filename')");

		$err="<font color='green'>Notice added Successfully</font>";
		$query=mysqli_query($conn,"select * from user where email !='$user' and designation='Student' ");

		while($row=mysqli_fetch_assoc($query))
		{
			sendMail($row['email']);
		}	
	}

	
	
}
function sendMail($receiver)
	{
	$subject = "notice";
	$body = "
			You got a new notice.
			 ";
	$sender = "From:joybhowmik67@gmail.com";
	
	mail($receiver, $subject, $body, $sender);
	
}
?>
<h2 class="page-header">Add New Notice</h2>
<form method="post" enctype="multipart/form-data">
	
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4"><?php echo @$err;?></div>
	</div>
	
	
	
	<div class="row">
		<div class="col-sm-4">Enter File</div>
		<div class="col-sm-5">
		<input type="file" name="file" class="form-control" required/></div>
	</div>
	
	
	<br>
	
	<div class="row">
		<div class="col-sm-4">Enter Details</div>
		<div class="col-sm-5">
		<textarea name="details" class="form-control" required></textarea></div>
	</div>
	
	
	
	<br>
	
		
		<div class="row" style="margin-top:10px">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
		<input type="submit" value="Add New Notice" name="add" class="btn btn-success"/>
		<input type="reset" class="btn btn-success"/>
		</div>
	</div>
</form>	