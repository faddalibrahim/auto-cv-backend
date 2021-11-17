<?php
// $receiver = "faddalibrahim@gmail.com";
// $subject = "I am testing the mailing system";
// $body = "Hi, there...This is a test email send from Localhost.";
// $sender = "autocvteam@gmail.com";
// if(mail($receiver, $subject, $body,$sender)){
//     echo "Email sent successfully to $receiver";
// }else{
//     echo "Sorry, failed while sending mail!";
// }


$to = "codewiz2019@gmail.com";
$subject = "This is a test subject";
$msg = "Hello codewiz";
$headers = "From: autocvteam@gmail.com";

if(mail($to,$subject,$msg,$headers)){
    echo "Email successfully sent to $to";
}else{
    echo "Sorry, failed while sending mail!";
}


// mail($receiver, $subject, $body, $sender);
?>