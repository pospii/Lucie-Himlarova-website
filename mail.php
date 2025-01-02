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
    $to = 'admin@kancelarlekare.cz'; // Zde vložte cílový e-mail
    $email_subject = "Nová zpráva z formuláře: " . $input['subject'];
    $email_body = "
    Jméno: " . $input['name'] . "\n
    Email: " . $input['email'] . "\n
    Telefon: " . $input['phone'] . "\n
    Předmět: " . $input['subject'] . "\n
    Zpráva:\n" . $input['message'] . "\n
    ";

    $headers = "From: " . $input['email'] . "\r\n";
    $headers .= "Reply-To: " . $input['email'] . "\r\n";

    // Odeslání e-mailu
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo json_encode(['success' => true, 'message' => 'Zpráva byla úspěšně odeslána.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Došlo k chybě při odesílání zprávy. Zkuste to prosím znovu.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Formulář musí být odeslán metodou POST.']);
}
?>





