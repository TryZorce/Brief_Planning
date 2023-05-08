<?php
class Task {
  private $id;
  private $title;
  private $description;
  private $completed;

  public function __construct($id, $title, $description, $completed) {
    $this->id = $id;
    $this->title = $title;
    $this->description = $description;
    $this->completed = $completed;
  }

  public function getId() {
    return $this->id;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getDescription() {
    return $this->description;
  }

  public function isCompleted() {
    return $this->completed;
  }

  public function setTitle($title) {
    $this->title = $title;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function setCompleted($completed) {
    $this->completed = $completed;
  }
}

