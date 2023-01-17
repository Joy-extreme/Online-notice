<?php
require('connection.php');


//check user alereay exists or not
$email= $_POST['email'];
$sql=mysqli_query($conn,"select * from user where email='$email'");

$r=mysqli_num_rows($sql);

if($r==true)
{
    echo '<script>alert("This user already exists");
    location="Registration.html";
    </script>';
}

else
{
$name= $_POST['firstName']." ".$_POST['lastName'];

//encrypt your password
$pass=md5($_POST['Password']);
$vcode= bin2hex(random_bytes(8));

$query="";
if(isset($_POST['studentID']))
{
    if(checkemailStd($email) && sendMail($email,$vcode))
    {
        $id= $_POST['studentID'];
        $designation='Student';
        $query="insert into user(`designation`,`Student_Id`,`name`,`email`,`pass`,`Vcode`) values('$designation','$id','$name','$email','$pass','$vcode')";

    }
    else
    {
        echo '<script>alert("Invalid email");
        location="Registration.html";
        </script>'; 
    }
   
}
if(isset($_POST['designation']))
{
    if(checkemailTeacher($email) && sendMail($email,$vcode))
    {
        $designation= $_POST['designation'];
        $query="insert into user(`designation`,`name`,`email`,`pass`,`Vcode`) values('$designation','$name','$email','$pass','$vcode')";

    }
    else
    {
        echo '<script>alert("Invalid email");
        location="Registration.html";
        </script>'; 
    }
}

mysqli_query($conn,$query);
echo '<script>alert("Registration request is successful. Check mail for verification.");
    location="index.php";
    </script>';

}


function checkemailStd($str) {
    return (!preg_match("/^[\w]+25[0-9][0-9]@student\.nstu.edu.bd$/i", $str)) ? FALSE : TRUE;
}
function checkemailTeacher($str) {
    return (!preg_match("/^[\w]+@nstu\.edu.bd$/i", $str)) ? FALSE : TRUE;
}

function sendMail($receiver,$vcode)
{
$subject = "User registration verification";
$body = "<html>
        <a href='http://localhost/noticeBoard/emailVerify.php?email=$receiver&vcode=$vcode'>Click here to verify</a>
        </body>
        </html> ";
$sender = "From:joybhowmik67@gmail.com";
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$sender."\r\n".
    'Reply-To: '.$sender."\r\n" .
    'X-Mailer: PHP/' . phpversion();
if(mail($receiver, $subject, $body, $headers)){
    return true;
}
else{
    return false;
}
}

?>


