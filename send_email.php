<?php
// Include the configuration file
$config = include('config.php');
$allowed_origins = $config['allowed_origins'];

// Check if the origin of the request is in the allowed origins list
if (isset($_SERVER['HTTP_ORIGIN'])) {
    if (in_array($_SERVER['HTTP_ORIGIN'], $allowed_origins)) {
        header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
    } else {
        // Block requests with invalid origins
        header("HTTP/1.1 403 Forbidden");
        exit;
    }
} else {
    // Block requests with null origin (e.g., file:// protocol)
    header("HTTP/1.1 403 Forbidden");
    exit;
}

header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Preflight request handling
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit;
}

include('smtp/PHPMailerAutoload.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $client_email = $data['to_email'];
    $client_name = $data['name'];

    // Email template for client acknowledgement
    $acknowledgement_message = file_get_contents('./email_template/acknowledgement_email.html');
    $acknowledgement_message = str_replace('{{name}}', $client_name, $acknowledgement_message);

    // Email template for notification to receiver
    $receiver_notification = file_get_contents('./email_template/receiver_notification.html');
    $receiver_notification = str_replace('{{name}}', $client_name, $receiver_notification);
    $receiver_notification = str_replace('{{email}}', $client_email, $receiver_notification);
    $receiver_notification = str_replace('{{message}}', $data['message'], $receiver_notification);

    // Use credentials from config.php
    $receiver_email = $config['receiver']['email'];
    $receiver_name = $config['receiver']['name'];

    // Send email to the receiver from the client's email address
    $result1 = smtp_mailer($receiver_email, "New Contact Message", $receiver_notification, $client_email, $client_name, $config);

    // Send email to the client from the receiver's email address (acknowledgement)
    $result2 = smtp_mailer($client_email, "Reply from $receiver_name", $acknowledgement_message, $receiver_email, $receiver_name, $config);

    // Check results and return appropriate response
    if ($result1 === 'Sent' && $result2 === 'Sent') {
        echo 'Mr. Brean will get back to you faster!';
    } else {
        echo 'Failed to submit.';
    }
}

function smtp_mailer($to, $subject, $msg, $from_email, $from_name, $config)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = $config['smtp']['encryption'];
    $mail->Host = $config['smtp']['host'];
    $mail->Port = $config['smtp']['port'];
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    //$mail->SMTPDebug = 2; 
    $mail->Username = $config['smtp']['username']; //admin/sender Email address
    $mail->Password = $config['smtp']['password']; //admin/sender Password
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
