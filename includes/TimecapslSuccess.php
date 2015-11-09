<?php namespace Timecapsl;

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
