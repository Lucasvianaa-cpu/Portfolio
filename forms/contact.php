<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


include('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
include('../vendor/phpmailer/phpmailer/src/Exception.php');
include('../vendor/phpmailer/phpmailer/src/SMTP.php');

$mail = new PHPMailer(true);

try {
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'devlucasviana@gmail.com';
  $mail->Password = 'apoieiwuoivuyewt'; 
  $mail->SMTPSecure = 'ssl'; 
  $mail->Port = 465; 

  $fromName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $fromEmail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
  $message = nl2br(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING));

  if (!$fromEmail) {
      throw new Exception('Endereço de email inválido');
  }

  $mail->setFrom($fromEmail, $fromName);

  $mail->addAddress('devlucasviana@gmail.com', 'Destinatário Nome');

  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body    = '<b>Nome:</b> ' . $fromName . '<br>'
                 . '<b>Email:</b> ' . $fromEmail . '<br>'
                 . '<b>Mensagem:</b><br>' . $message;

  $mail->send();
  echo 'Sua mensagem foi enviada!';
} catch (Exception $e) {
  echo "A mensagem não pôde ser enviada.{$mail->ErrorInfo}";
}
?>