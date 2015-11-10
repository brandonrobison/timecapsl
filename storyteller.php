<?php namespace Timecapsl;

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

// storyteller.php
// Sends an email from the site storyteller form to the site admin

$form = new StorytellerForm($_POST['name'], $_POST['question1'], $_POST['question2'], $_POST['question3'], $_POST['question4']);
$request = new ContactFormRequest($config, 'storyteller_form');
$request->processRequest($form);
