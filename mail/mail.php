<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Získání dat z formuláře
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validace vstupů
    if (empty($name) || empty($email) || empty($phone) || empty($subject) || empty($message)) {
        die('Všechna pole jsou povinná.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Neplatná e-mailová adresa.');
    }

    // Nastavení e-mailu
    $to = 'admin@kancelarlekare.cz'; // Zde vložte cílový e-mail
    $email_subject = "Nová zpráva z formuláře: $subject";
    $email_body = "
    Jméno: $name\n
    Email: $email\n
    Telefon: $phone\n
    Předmět: $subject\n
    Zpráva:\n$message\n
    ";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Odeslání e-mailu
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo 'Zpráva byla úspěšně odeslána.';
    } else {
        echo 'Došlo k chybě při odesílání zprávy. Zkuste to prosím znovu.';
    }
} else {
    echo 'Formulář musí být odeslán metodou POST.';
}
?>



