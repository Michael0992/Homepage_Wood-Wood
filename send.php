<?php

// Eingaben bereinigen und validieren
$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
$message = htmlspecialchars(trim($_POST['message']));

if (!$name || !$email || !$message) {
    echo "Ungültige Eingabe. Bitte alle Felder korrekt ausfüllen.";
    exit;
}

// E-Mail vorbereiten
$to = "michel.lutz92@gmail.com";
$subject = "Von $name mit der E-Mail: $email";
$body = $message;
$headers = "From: no-reply@woodundwood.de\r\n" .
           "Reply-To: $email\r\n" .
           "Content-Type: text/plain; charset=UTF-8";

// E-Mail senden
if (mail($to, $subject, $body, $headers)) {
    echo "<!DOCTYPE html>
    <html lang='de'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Nachricht gesendet - Wood &amp; Wood Zimmerei</title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>
    <header>
        <nav>
            <a href='index.html'>Startseite</a>
            <a href='Kontakt.html'>Kontakt</a>
            <a href='FAQ.html'>FAQ</a>
        </nav>
    </header>
    <div class='container'>
        <section>
            <h2>Nachricht gesendet</h2>
            <p>Vielen Dank für Ihre Nachricht, ". htmlspecialchars($name) . "! Wir werden uns so bald wie möglich bei Ihnen melden.</p>
        </section>
    </div>
    <footer>
        <p>&copy; 2024 Wood &amp; Wood Zimmerei</p>
        <p>Christoph Wacker - Hauptstr. 2, 76779 Scheibenhardt</p>
        <a style='color: white;' href='Datenschutz.html'>Datenschutzerklärung</a>
    </footer>
    </body>
    </html>";
} else {
    echo "Nachricht konnte nicht gesendet werden. Bitte versuchen Sie es später erneut.";
}
?>
