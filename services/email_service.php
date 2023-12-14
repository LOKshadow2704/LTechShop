<?php
require './vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

function sendEmail($recipient, $subject, $body)
{
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_OFF;

        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';

        $mail->SMTPAuth = true;

        $mail->Username = 'dongphucthiennam@gmail.com';
        $mail->Password = 'cniy iari wosv dozf';

        $mail->SMTPSecure = 'tls';

        $mail->Port = 587;

        $mail->setFrom('dongphucthiennam@gmail.com', 'TechShop');
        $mail->addAddress($recipient);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();

        // echo 'Email sent successfully!';
    } catch (Exception $e) {
        echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
    }
}
