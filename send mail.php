<?php
$receiver = "joybhowmik173@gmail.com";
$subject = "User registration verification";
$body = "<html>
        <a href='https://www.facebook.com/moumita.moumita.961'>Click here to verify</a>
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
    echo "Email sent successfully to $receiver";
}else{
    echo "Sorry, failed while sending mail!";
}
?>