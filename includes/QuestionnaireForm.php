<?php namespace Timecapsl;

class QuestionnaireForm {
  public $name = '';
  public $previous_names = '';
  public $dob = '';
  public $birthplace = '';
  public $mother = '';
  public $father = '';
  public $siblings = '';
  public $important_people = '';
  public $college = '';
  public $military = '';
  public $career = '';
  public $married = '';
  public $children = '';
  public $religion = '';
  public $anything_else = '';
  public $contact_info = '';
  public $limitations = '';

  public function __construct($name, $previous_names, $dob, $birthplace, $mother, $father, $siblings, $important_people, $college, $military, $career, $married, $children, $religion, $anything_else, $contact_info, $limitations) {
	$this->name = $name;
	$this->previous_names = $previous_names;
	$this->dob = $dob;
	$this->birthplace = $birthplace;
	$this->mother = $mother;
	$this->father = $father;
	$this->siblings = $siblings;
	$this->important_people = $important_people;
	$this->college = $college;
	$this->military = $military;
	$this->career = $career;
	$this->married = $married;
	$this->children = $children;
	$this->religion = $religion;
	$this->anything_else = $anything_else;
	$this->contact_info = $contact_info;
	$this->limitations = $limitations;
  }

  public function isValid() {
    return !empty($this->name) &&
      !empty($this->dob) &&
      !empty($this->birthplace) &&
	  !empty($this->mother) &&
	  !empty($this->father) &&
	  !empty($this->important_people) &&
	  !empty($this->career) &&
	  !empty($this->contact_info) &&
	  !empty($this->limitations);
  }

  public function data() {
    return array(
      'name' => $this->name,
      'previous_names' => $this->previous_names,
      'dob' => $this->dob,
      'birthplace' => $this->birthplace,
      'mother' => $this->mother,
      'father' => $this->father,
      'siblings' => $this->siblings,
      'important_people' => $this->important_people,
      'college' => $this->college,
      'military' => $this->military,
      'career' => $this->career,
      'married' => $this->married,
      'children' => $this->children,
      'religion' => $this->religion,
      'anything_else' => $this->anything_else,
      'contact_info' => $this->contact_info,
      'limitations' => $this->limitations
    );
  }
}
