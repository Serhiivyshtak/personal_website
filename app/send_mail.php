<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';


function mail_send (string $mail_content, string $mail_subject, array $recipients) {

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();                                  
        $mail->Host       = 'smtp.gmail.com';                   
        $mail->SMTPAuth   = true;                                
        $mail->Username   = 'svndev127@gmail.com';                 
        $mail->Password   = 'rzxy bfku vdff twnd';                          
        $mail->SMTPSecure = 'auto';         
        $mail->Port = 587;                                    
    
        $mail->setFrom('svndev127@gmail.com', 'Serhii Vyshtak');
        for ($i = 0; $i < count($recipients); $i++) {
            $mail->addAddress($recipients[$i]);
        }    

        $mail->addReplyTo('svndev127@gmail.com');  
    
        $mail->isHTML(false);                               
        $mail->Subject = $mail_subject;
        $mail->Body = $mail_content;
    
        return $mail->send();
    } catch (Exception $e) {
        return false;
    }
}


if (isset($_POST["subject"]) && isset($_POST["answer"]) && isset($_POST["email"])) {
    mail_send($_POST["answer"], $_POST["subject"], [$_POST["email"]]);
    header("Location: disable_message.php?msg=".$_GET["msg"]);
} else {
    header("Location: ../indexx.html");
}