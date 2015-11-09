<?php namespace Timecapsl;

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
