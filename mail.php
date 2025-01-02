<?php
// Nastavení hlaviček pro JSON odpověď
header('Content-Type: application/json');

// Kontrola metody
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Získání dat z JSON
    $input = json_decode(file_get_contents('php://input'), true);

    // Validace vstupů
    if (empty($input['name']) || empty($input['email']) || empty($input['phone']) || empty($input['subject']) || empty($input['message'])) {
        echo json_encode(['success' => false, 'message' => 'Všechna pole jsou povinná.']);
        exit;
    }

    if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Neplatná e-mailová adresa.']);
        exit;
    }

    // Nastavení e-mailu
    $to = 'luciehimlarova@kancelarlekare.cz'; // Cílový e-mail
    $email_subject = "Nová zpráva z formuláře: " . $input['subject'];
    $email_body = "
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

    $headers = "From: " . $input['email'] . "\r\n";
    $headers .= "Reply-To: " . $input['email'] . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $return_path = "-f luciehimlarova@kancelarlekare.cz";

    // Odeslání e-mailu
    if (mail($to, $email_subject, $email_body, $headers, $return_path)) {
        echo json_encode(['success' => true, 'message' => 'Zpráva byla úspěšně odeslána.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Došlo k chybě při odesílání zprávy. Zkuste to prosím znovu.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Formulář musí být odeslán metodou POST.']);
}
?>





