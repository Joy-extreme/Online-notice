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
		move_uploaded_file($_FILES['file']['tmp_name'],"../file/".$_FILES['file']['name']);
		$noticeIssuer="admin";
		$name= "Section office";
		
        mysqli_query($conn,"insert into notice(`Description`,`noticeIssuer`,`userType`,`name`,`FileName`) values('$details','$noticeIssuer','$userType','$name','$filename')");

		$err="<font color='green'>Notice added Successfully</font>";
		if($userType=='Student')
		{
			$query=mysqli_query($conn,"select * from user where email !='$admin' and designation='Student' ");

			while($row=mysqli_fetch_assoc($query))
			{
				sendMail($row['email']);
			}

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
	<div class="row">
		<div class="col-sm-4">Choose audience</div>
		<div class="col-sm-5">
		<select name="userType" id="designation" class="form-control" required>
                  <option value="All">All</option>
                  <option value="Student">Student</option>
                  <option value="Faculty member">Faculty member</option>
        </select>
	    </div>
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