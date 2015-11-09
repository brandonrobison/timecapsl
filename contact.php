<?php namespace Timecapsl;

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

// contact.php
// Sends an email from the site contact form to the site admin

$form = new ContactForm($_POST['email'], $_POST['name'], $_POST['message']);
$request = new ContactFormRequest($config, 'contact_form');
$request->processRequest($form);
