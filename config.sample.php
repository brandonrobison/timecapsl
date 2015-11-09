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
