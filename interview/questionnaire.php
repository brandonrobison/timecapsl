<?php namespace Timecapsl;

require '../vendor/autoload.php';
require_once '../config.php';

// questionnaire.php
// Sends an email from the site new client / pre interview questionnaire to the site admin

$form = new QuestionnaireForm($_POST['name'], $_POST['previous_names'], $_POST['dob'], $_POST['birthplace'], $_POST['mother'], $_POST['father'], $_POST['siblings'], $_POST['important_people'], $_POST['college'], $_POST['military'], $_POST['career'], $_POST['married'], $_POST['children'], $_POST['religion'], $_POST['anything_else'], $_POST['contact_info'], $_POST['limitations']);
$request = new ContactFormRequest($config, 'questionnaire_form');
$request->processRequest($form);
