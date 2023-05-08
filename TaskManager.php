<?php
require_once('Task.php');

class TaskManager {
  private $db;

  public function __construct($host, $dbname, $username, $password) {
    $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function getAllTasks() {
    $tasks = array();

    $stmt = $this->db->prepare('SELECT * FROM task');
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $task = new Task($row['id'], $row['title'], $row['description'], $row['completed']);
      $tasks[] = $task;
    }

    return $tasks;
  }

  public function addTask($title, $description) {
    $stmt = $this->db->prepare('INSERT INTO task (title, description) VALUES (?, ?)');
    $stmt->execute([$title, $description]);
  }

  public function deleteTask($id) {
    $stmt = $this->db->prepare('DELETE FROM task WHERE id = ?');
    $stmt->execute([$id]);
  }
  public function saveTask(Task $task) {
    $stmt = $this->db->prepare('UPDATE task SET title = ?, description = ?, completed = ? WHERE id = ?');
    $stmt->execute([$task->getTitle(), $task->getDescription(), $task->isCompleted(), $task->getId()]);
  }
  
  public function editTask($id, $title, $description, $completed) {
    $task = $this->getTask($id);
  
    if (!$task) {
      // La tâche n'existe pas, gérer l'erreur ou afficher un message approprié
      return;
    }
  
    if (empty($title)) {
      $title = $task->getTitle();
    }
  
    if (empty($description)) {
      $description = $task->getDescription();
    }
  
    $task->setTitle($title);
    $task->setDescription($description);
    $task->setCompleted($completed);
  
    $this->saveTask($task);
  }
  

public function getTask($id)
{
    $stmt = $this->db->prepare('SELECT * FROM task WHERE id = ?');
    $stmt->execute([$id]);

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        return new Task($row['id'], $row['title'], $row['description'], $row['completed']);
    }

    return null;
}


}
