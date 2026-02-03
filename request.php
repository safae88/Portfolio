<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/MAIL/Exception.php';
require 'src/MAIL/PHPMailer.php';
require 'src/MAIL/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name    = htmlspecialchars($_POST["name"]);
    $email   = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);
    $number  = htmlspecialchars($_POST["number"]);

    $mail = new PHPMailer(true);

    try {
        
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        $mail->Username   = 'safaebouchouicha@gmail.com';   
        $mail->Password   = 'jzvz jiyi hccm pmoq';  

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom($email, $name);
        $mail->addAddress('safaebouchouicha@gmail.com');

        $mail->Subject = $subject;

        $mail->Body =
            "Name: $name\n" .
            "Email: $email\n" .
            "Phone: $number\n\n" .
            "Message:\n$message";

        $mail->send();
        echo "Message sent successfully !";

    } catch (Exception $e) {
        echo "Message could not be sent !";
    }
}
?>
