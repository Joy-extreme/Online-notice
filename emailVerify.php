<?php
require('connection.php');
session_start();
$email=$_GET['email'];
$vcode=$_GET['vcode'];

$sql=mysqli_query($conn,"SELECT * from user where email='$email' AND Vcode='$vcode'");

$r=mysqli_num_rows($sql);
$fetch=mysqli_fetch_assoc($sql);
if($r==true)
{
    if($fetch['verifyStatus'] == 0)
    {
        $updateSql=mysqli_query($conn,"UPDATE user SET verifyStatus=verifyStatus+1 where email='$email' AND Vcode='$vcode'");
        if($updateSql)
        {
            $_SESSION['user']=$fetch['email'];
            echo '<script>alert("User is successfully verified");
            location="http://localhost/noticeBoard/user";
            </script>';

        }
        

    }
    
    else
    {
        echo '<script>alert("This user already registered");
        location="http://localhost/noticeBoard/index.php";
        </script>';
    }
}
?>