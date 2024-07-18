<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include('smtp/PHPMailerAutoload.php');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // Preflight request
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $client_email = $data['to_email'];
    $client_name = $data['name'];

    // Email template for client acknowledgement
    $acknowledgement_message = file_get_contents('acknowledgement_email.html');
    $acknowledgement_message = str_replace('{{name}}', $client_name, $acknowledgement_message);

    // Email template for notification to receiver
    $receiver_notification = file_get_contents('receiver_notification.html');
    $receiver_notification = str_replace('{{name}}', $client_name, $receiver_notification);
    $receiver_notification = str_replace('{{email}}', $client_email, $receiver_notification);
    $receiver_notification = str_replace('{{message}}', $data['message'], $receiver_notification);

    // Receiver's email address (update with actual receiver's email)
    $receiver_email = "example@gmail.com";
    $receiver_name = "Mr. Bean";

    // Send email to the receiver from the client's email address
    $result1 = smtp_mailer($receiver_email, "New Contact Message", $receiver_notification, $client_email, $client_name);

    // Send email to the client from the receiver's email address (acknowledgement)
    $result2 = smtp_mailer($client_email, "Reply from $receiver_name", $acknowledgement_message, $receiver_email, $receiver_name);

    // Check results and return appropriate response
    if ($result1 === 'Sent' && $result2 === 'Sent') {
        echo 'Email sent successfully!';
    } else {
        echo 'Failed to send emails.';
    }
}

function smtp_mailer($to, $subject, $msg, $from_email, $from_name)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    //$mail->SMTPDebug = 2; 
    $mail->Username = "sender@gmail.com"; //admin/sender Email address
    $mail->Password = "vlzc lzst cmqh azrd"; //admin/sender Password
    $mail->SetFrom($from_email, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->AddAddress($to);
    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => false
    ));
    if (!$mail->Send()) {
        return $mail->ErrorInfo;
    } else {
        return 'Sent';
    }
}
?>
