<?php
extract($_POST);
if(isset($update))
{
	$err="<font color='blue'>Notice updated </font>";

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
			
			$id=$_GET['notice_id'];
			$userType="All";
			$query=mysqli_query($conn,"UPDATE notice set userType='$userType',Description='$details',FileName='$filename' where notice_id=$id");
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
			You got a notice updated.
			 ";
	$sender = "From:joybhowmik67@gmail.com";
	
	mail($receiver, $subject, $body, $sender);
	
}

//select old notice

$q=mysqli_query($conn,"select * from notice where notice_id='".$_GET['notice_id']."'");
$res=mysqli_fetch_array($q);

?>
<h2 class="page-header">UPDATE NOTICE</h2>
<form method="post" enctype="multipart/form-data">

	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4"><?php echo @$err;?></div>
	</div>

    <br>
	<div class="row">
		<div class="col-sm-4">Enter File</div>
		<div class="col-sm-5">
		<input type="file" name="file" class="form-control" required/></div>
	</div>

	<br>

	<div class="row">
		<div class="col-sm-4">Enter Details</div>
		<div class="col-sm-5">
		<textarea name="details" class="form-control" required><?php echo $res['Description']; ?></textarea></div>
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

	

		<div class="row" style="margin-top:10px">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
		<input type="submit" value="Update Notice" name="update" class="btn btn-success"/>
		<input type="reset" class="btn btn-success"/>
		</div>
	</div>
</form>
