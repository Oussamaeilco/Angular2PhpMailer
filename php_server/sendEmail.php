<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '\vendor\phpmailer\phpmailer\src\Exception.php';
require_once __DIR__ . '\vendor\phpmailer\phpmailer\src\PHPMailer.php';
require_once __DIR__ . '\vendor\phpmailer\phpmailer\src\SMTP.php';

// passing true in constructor enables exceptions in PHPMailer

switch($_SERVER['REQUEST_METHOD']){
    case("OPTIONS"): //Allow preflighting to take place.
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST,OPTIONS");
        header("Access-Control-Allow-Headers: content-type");
        exit;
    case("POST"): //Send the email;
        
        header("Access-Control-Allow-Origin: *");

        $json = file_get_contents('php://input');

        $params = json_decode($json);

        $email = $params->email;
        $name = $params->name;
        $message = $params->message;
        
        $recipient = 'support@dotnet-services.fr';
        $subject = 'new message';
        //$headers = "From: $name <$email>";

        //mail($recipient, $subject, $message, $headers);*/

        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_CONNECTION; // for detailed debug output
            $mail->isSMTP();
            $mail->Host = 'mail42.lwspanel.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->Username = 'support@dotnet-services.fr'; // YOUR gmail email
            $mail->Password = 'Ee214627yz$'; // YOUR gmail password

            // Sender and recipient settings
            $mail->setFrom($email, $name);
            $mail->addAddress($recipient, $name);
            //$mail->addReplyTo('example@gmail.com', 'Sender Name'); // to set the reply to

            // Setting the email content
            $mail->IsHTML(true);
            $mail->Subject = $subject;
            $mail->Body = "<div>$message</div>";
            $mail->AltBody = $message;

            $mail->send();
            echo "Email message sent.";
        } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        }

        break;
    default: //Reject any non POST or OPTIONS requests.
        header("Allow: POST", true, 405);
        exit;
}