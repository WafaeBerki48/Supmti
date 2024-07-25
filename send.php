<?php
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                  // Enable SMTP authentication
    $mail->Username   = 'bmdouae5@gmail.com';                 // SMTP username
    $mail->Password   = 'kmjp mzgo eunj rtfv';                 // SMTP password
    $mail->SMTPSecure = 'ssl';                                 // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 465;                                   // TCP port to connect to

    // Sender and recipient
    $mail->setFrom('bmdouae5@gmail.com', 'SUPMTI');

    // Retrieve newly inserted data from the database
    require_once 'admin/config.php';

    if ($connexion->connect_error) {
        die("La connexion a échoué : " . $connexion->connect_error);
    }

    // Get the latest inserted record
    $latest_record_query = "SELECT * FROM concours ORDER BY id DESC LIMIT 1";
    $latest_record_result = $connexion->query($latest_record_query);
    $latest_record = $latest_record_result->fetch_assoc();

    $mail->addAddress($latest_record['email']); // Add a recipient using the email retrieved from the database

    // Add photo to the convocation
    $mail->AddEmbeddedImage('img/5.png', 'photo');    // Add a photo to the convocation

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'CONVOCATION';
    $mail->Body    = 'Dear ' . $latest_record["nom"] . ' ' . $latest_record["prenom"] . ' <br><br> Voici votre convocation pour le concours scolaire : <br><br>Nous avons le plaisir de vous informer que vous avez été inscrit avec succès au concours scolaire.
    La compétition aura lieu dans  ' . $latest_record["centre"] . ' le  ' . $latest_record["date"] . '.Veuillez arriver sur le site de la compétition avant 8h00. Le coup d’envoi de la compétition sera donné à 9h00 précises. <br><br>Bonne chance!<br><br>Le comité du concours de l’école :<br><br><img src="cid:photo" alt="Photo">';

    $mail->send();
    echo "
    <script>
    alert('Send Successfully');
    document.location.href ='index.php';
    </script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
