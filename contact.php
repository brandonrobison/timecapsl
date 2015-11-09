<?php namespace Timecapsl;

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

// contact.php
// Sends an email from the site contact form to the site admin

// Emails the message provided by the contact form.
function sendContactFormEmail($form) {
  global $config;
  $mailerConfig = $config['PHPMailer'];
  $mail = new \PHPMailer;

  $mail->isSMTP();
  $mail->SMTPAuth = true;
  $mail->Host = $mailerConfig['Host'];
  $mail->Username = $mailerConfig['Username'];
  $mail->Password = $mailerConfig['Password'];
  $mail->SMTPSecure = $mailerConfig['SMTPSecure'];
  $mail->Port = $mailerConfig['Port'];
  $mail->setFrom('webmaster@timecap.sl');
  $mail->addAddress('me@brandonrobison.com');
  $mail->addReplyTo($form->email, $form->name);
  $mail->isHTML(false);

  $mail->Subject = "Contact form submitted by: $form->name";
  $mail->Body = renderContactFormEmail($form);
  if (!$mail->send()) {
    return new TimecapslError('Message could not be sent. ' . 'Mailer Error: ' . $mail->ErrorInfo);
  }

  return new TimecapslSuccess($form);
}

// Renders the email template for the contact form.
function renderContactFormEmail($form) {
  $loader = new \Twig_Loader_Filesystem(__DIR__ . '/templates');
  $twig = new \Twig_Environment($loader, array());

  return $twig->render('emails/contact_form.html', $form->data());
}

function validateForm($form) {
  if (!$form->isValid()) {
    return new TimecapslError("No arguments Provided!");
  }

  return new TimecapslSuccess($form);
}

function validateRecaptcha($form) {
  global $config;
  $recaptcha = new \ReCaptcha\ReCaptcha($config['ReCaptcha']['secret']);
  $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
  if (!$resp->isSuccess()) {
    return new TimecapslError("Unable to verify ReCaptcha: " . join(', ', $resp->getErrorCodes()));
  }

  return new TimecapslSuccess($form);
}

$form = new ContactForm($_POST['email'], $_POST['name'], $_POST['message']);
$result =
  validateForm($form)->
    then(function ($f) {
      return validateRecaptcha($f);
    })->
    then(function ($f) {
      return sendContactFormEmail($f);
    })->
    error(function ($message) {
      http_response_code(400);
      echo $message;
    });
