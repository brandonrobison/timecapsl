<?php

class ContactForm {
  public $email = '';
  public $name = '';
  public $message = '';

  public function __construct($email, $name, $message) {
    $this->email = $email;
    $this->name = $name;
    $this->message = $message;
  }

  public function isValid() {
    return !empty($this->name) &&
      !empty($this->message) &&
      !empty($this->email) &&
      filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false;
  }

  public function data() {
    return array(
      'email' => $this->email,
      'name' => $this->name,
      'message' => $this->message
    );
  }
}
