<?php
// Crear nombres cortos de variables
//crea variable y escribe o si no hay valor asignado mediante
//operador ternario.
//trim() --> limpia los valores introducidos.
$name = isset($_POST["name"]) ? trim($_POST["name"]) : '';
$email = isset($_POST["email"]) ? trim($_POST["email"] ): '';
$feedback = isset($_POST["feedback"]) ? trim($_POST["feedback"]) : '';

// Definir información estática
$toaddress = "feedback@bob.com";
$subject = "Feedback from the web site";
$mailcontent = "Customer name: " . filter_var($name, FILTER_SANITIZE_STRING) . "\n" .
    "Customer Email: " . filter_var($email, FILTER_SANITIZE_EMAIL) . "\n" .
    "Feedback Customer: " . filter_var($feedback, FILTER_SANITIZE_STRING) . "\n";

// Cabeceras
$headers = "From: webserver@bom.com\r\n";
$headers .= "Reply-To: " . filter_var($email, FILTER_SANITIZE_EMAIL) . "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Invocar la función mail() para enviar correo
if (mail($toaddress, $subject, $mailcontent, $headers)) {
    echo "Mail sent successfully.";
} else {
    echo "Mail could not be sent.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bob's Auto Parts -- Feedback Submitted--</title>
</head>w3e
<body>
<h1>Feedback Submitted</h1>
<p style="color: green">your feedback has been sent</p>


</body>
</html>
