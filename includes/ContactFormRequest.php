<?php namespace Timecapsl;

class ContactFormRequest {
  public function __construct($config, $templateName) {
    $this->config = $config;
    $this->templateName = $templateName;
  }

  function processRequest($form) {
    return
      $this->validateForm($form)->
      then(function ($f) {
        return $this->validateRecaptcha($f);
      })->
      then(function ($f) {
        return $this->sendEmail($f);
      })->
      error(function ($message) {
        http_response_code(400);
        echo $message;
      });
  }

  function validateForm($form) {
    if (!$form->isValid()) {
      return new TimecapslError("No arguments Provided!");
    }

    return new TimecapslSuccess($form);
  }

  function validateRecaptcha($form) {
    $recaptcha = new \ReCaptcha\ReCaptcha($this->config['ReCaptcha']['secret']);
    $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
    if (!$resp->isSuccess()) {
      return new TimecapslError("Unable to verify ReCaptcha: " . join(', ', $resp->getErrorCodes()));
    }

    return new TimecapslSuccess($form);
  }

  function sendEmail($form) {
    $mailerConfig = $this->config['PHPMailer'];
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
    $mail->Body = $this->renderContactFormEmail($form);
    if (!$mail->send()) {
      return new TimecapslError('Message could not be sent. ' . 'Mailer Error: ' . $mail->ErrorInfo);
    }

    return new TimecapslSuccess($form);
  }

  function renderContactFormEmail($form) {
    $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../templates');
    $twig = new \Twig_Environment($loader, array());

    return $twig->render('emails/contact_form.html', $form->data());
  }
}
