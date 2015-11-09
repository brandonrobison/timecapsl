<?php

class TimecapslSuccess {
  public $value;

  public function __construct($value) {
    $this->value = $value;
  }

  public function then($f) {
    return $f($this->value);
  }

  public function isSuccess() {
    return true;
  }

  public function error($f) {
    return $this;
  }
}

class TimecapslError {
  public $message;

  public function __construct($message) {
    $this->message = $message;
  }

  public function then($f) {
    return $this;
  }

  public function isSuccess() {
    return false;
  }

  public function error($f) {
    return $f($this->message);
  }
}
