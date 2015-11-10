<?php namespace Timecapsl;

class StorytellerForm {
  public $name = '';
  public $question1 = '';
  public $question2 = '';
  public $question3 = '';
  public $question4 = '';

  public function __construct($name, $question1, $question2, $question3, $question4) {
	$this->name = $name;
	$this->question1 = $question1;
	$this->question2 = $question2;
	$this->question3 = $question3;
	$this->question4 = $question4;
  }

  public function isValid() {
    return !empty($this->name) &&
      !empty($this->question1) &&
      !empty($this->question2) &&
	  !empty($this->question3) &&
	  !empty($this->question4);
  }

  public function data() {
    return array(
      'name' => $this->name,
      'question1' => $this->question1,
      'question2' => $this->question2,
      'question3' => $this->question3,
      'question4' => $this->question4
    );
  }
}
