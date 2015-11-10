<?php
// Copy this file to config.php and update values as needed.

$config = array();

$config['PHPMailer'] = array(
  'Host' => 'smtp1.example.com;smtp2.example.com',
  'Username' => 'user@example.com',
  'Password' => 'secret',
  'SMTPSecure' => 'tls',
  'Port' => 587
);

$config['ReCaptcha'] = array(
  'secret' => 'RECAPTCHA_SECRET'
);

// List of form emails sent by the system. Each email can have the following
// properties:
// * to - the email address that will receive the form data.
// * from - the email address from which the form data will be sent.
// * subject - a string or function that will generate the subject line.
// * template - the path to the email template.
// * replyTo - whether or not to include a reply-to based on the form.
$config['FormMailerTemplates'] = array(
  'default' => array(
    'to' => 'me@brandonrobison.com',
    'from' => 'webmaster@timecap.sl',
    'replyTo' => false
  ),
  'contact_form' => array(
    'subject' => function ($form) {
      return "Contact form submitted by: $form->name";
    },
    'template' => 'emails/contact_form.html',
    'replyTo' => true
  ),
  'questionnaire_form' => array(
    'subject' => function ($form) {
      return "New Client / Pre-Interview Questionnaire from $form->name";
    },
    'template' => 'emails/questionnaire_form.html'
  )
);
