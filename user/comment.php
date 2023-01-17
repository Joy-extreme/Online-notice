<?php


$user= $_SESSION['user'];
$sql=mysqli_query($conn,"select * from user where email='$user' ");
$users=mysqli_fetch_assoc($sql);
$name= $users['name'];
$notice_id=$_GET['notice_id'];

extract($_POST);
if(isset($save))
{
	$sql=mysqli_query($conn,"insert into comment(`notice_id`,`personName`,`commentDetails`) values('$notice_id','$name','$comment')");

	echo "<script>alert('Comment is placed')</script>";
	
	
}

if(isset($like))
{
	
	$sql=mysqli_query($conn,"SELECT * from `likes` where email= '$user' and notice_id=$notice_id");
	
	$r= mysqli_num_rows($sql);
		
	if($r == false)
	{
		$sql=mysqli_query($conn,"INSERT into likes(`email`,`notice_id`) values('$user','$notice_id')");
		
		$sql=mysqli_query($conn,"UPDATE notice set likeCount= likeCount+1 where notice_id=$notice_id");
		echo "<script>alert('Like is placed')</script>";
	}
	else
	{
		echo "<script>alert('Like is already placed')</script>";
	}
	
}

if(isset($undo))
{
	
	$sql=mysqli_query($conn,"SELECT * from `likes` where email= '$user' and notice_id=$notice_id");
	
	$r= mysqli_num_rows($sql);
		
	if($r == true)
	{
		$sql=mysqli_query($conn,"DELETE from likes where email= '$user' and notice_id=$notice_id");
	
		
		$sql=mysqli_query($conn,"UPDATE notice set likeCount= likeCount-1 where notice_id=$notice_id");
		echo "<script>alert('Like is removed')</script>";
	}
	else
	{
		echo "<script>alert('Like is not placed yet')</script>";
	}
	
}




?>
<h2 class="page-header"><B>Comment</B></h2>
<form method="post">

	<div class="row">
		<div class="col-sm-4">Give your comment</div>
		<div class="col-sm-5">
		<textarea name="comment" class="form-control" required></textarea></div>
	</div>
	
	<br>
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">
	    </div>
		<div class="col-sm-4">


		<input type="submit" value="send" name="save" class="btn btn-success" />
		<input type="reset" class="btn btn-success"/>
		</div>
	</div>
	
	
	<br>
	
</form>
<form method="post">
<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Give like</div>
		<div class="col-sm-4">


		<input type="submit" value="like" name="like" class="btn btn-success"/>
	    <input type="submit" value="undo" name="undo" class="btn btn-success"/>
		</div>
	</div>
</form>
<br>
<hr>
<h2 class="page-header"><B>Previous comments</B></h2>

<?php
$q=mysqli_query($conn,"SELECT * from comment where notice_id=$notice_id");

while($row=mysqli_fetch_assoc($q))
{
    $name=$row['personName'];
    $date=$row['date'];
    $des=$row['commentDetails'];
    echo 
"
<div class='container' style='width:100%;' >
<div style='border: 1px solid #e6e6e6 '>
<div class='row'>
    <div class='col-sm-1'>
    </div>
    <div id='posts' class='col-sm-12'>
        <div class='row'>
            
            <div class='col-sm-12'>
                <h6><Strong style='text-decoration:none; cursor:pointer;color: #3897f0;'>$name</Strong></h6>
                <h6><small style='color:black;'>$date</small></h6>
            </div>
            <div class='col-sm-4'>
            </div>
        </div>
        <div class='row'>
            <div class='col-sm-12'>
                
                <h6 >$des</h6>
            </div>
        </div>
		";
        ?>
        
        <?php

       echo 
"</div>
    <div class='col-sm-3'>
    </div>
</div>
</div>
</div>
<br><br>
";

}
		?>
        


