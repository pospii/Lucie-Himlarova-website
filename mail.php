<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input = json_decode(file_get_contents('php://input'), true);

    if (empty($input['name']) || empty($input['email']) || empty($input['phone']) || empty($input['subject']) || empty($input['message'])) {
        echo json_encode(['success' => false, 'message' => 'Všechna pole jsou povinná.']);
        exit;
    }

    if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Neplatná e-mailová adresa.']);
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP nastavení
        $mail->isSMTP();
        $mail->Host       = 'wes1-smtp.wedos.net';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'lucie.himlarova@kancelarlekare.cz';
        $mail->Password   = 'Mujnewjob25.';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        // Odesílatel a příjemce
        $mail->setFrom('lucie.himlarova@kancelarlekare.cz', 'Kontaktní formulář');
        $mail->addAddress('lucie.himlarova@kancelarlekare.cz');
        $mail->addReplyTo(htmlspecialchars($input['email']), htmlspecialchars($input['name']));

        // Obsah emailu
        $mail->isHTML(true);
        $mail->Subject = 'Nová zpráva z formuláře: ' . htmlspecialchars($input['subject']);
        $mail->Body    = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 5px; }
                h2 { color: #f78769; }
                p { margin: 10px 0; }
                .label { font-weight: bold; }
                .message { margin-top: 20px; padding: 15px; background-color: #f4f4f4; border-left: 4px solid #f78769; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Nová zpráva z webového formuláře</h2>
                <p><span class='label'>Jméno:</span> " . htmlspecialchars($input['name']) . "</p>
                <p><span class='label'>Email:</span> " . htmlspecialchars($input['email']) . "</p>
                <p><span class='label'>Telefon:</span> " . htmlspecialchars($input['phone']) . "</p>
                <p><span class='label'>Předmět:</span> " . htmlspecialchars($input['subject']) . "</p>
                <div class='message'>
                    <p><span class='label'>Zpráva:</span></p>
                    <p>" . nl2br(htmlspecialchars($input['message'])) . "</p>
                </div>
            </div>
        </body>
        </html>";

        $mail->send();
        echo json_encode(['success' => true, 'message' => 'Zpráva byla úspěšně odeslána.']);

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Došlo k chybě při odesílání zprávy. Zkuste to prosím znovu.']);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'Formulář musí být odeslán metodou POST.']);
}
