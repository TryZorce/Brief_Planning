<?php
require_once('TaskManager.php');

$taskManager = new TaskManager('localhost', 'planning', 'root', 'root');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['add-task'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    if (!empty($title) && !empty($description)) {
      $taskManager->addTask($title, $description);
    }
  } elseif (isset($_POST['delete-task'])) {
    $id = $_POST['id'];
    $taskManager->deleteTask($id);
  } elseif (isset($_POST['edit-task'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $completed = isset($_POST['completed']) ? 1 : 0;
    $taskManager->editTask($id, $title, $description, $completed);
  }
}

$tasks = $taskManager->getAllTasks();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Task List</title>
</head>
<body>
  <h1>Task List</h1>
  <h2>Add a Task</h2>
  <form method="post">
    <input type="text" name="title" placeholder="Title">
    <input type="text" name="description" placeholder="Description">
    <button type="submit" name="add-task">Add Task</button>
  </form>
  <h2>Tasks</h2>
  <ul>
    <?php foreach ($tasks as $task): ?>
      <li>
        <strong><?= $task->getTitle() ?></strong> - <?= $task->getDescription() ?>
        <?php if ($task->isCompleted()): ?>
          <span style="color: green;">(Completed)</span>
        <?php endif ?>
        <form method="post">
          <input type="hidden" name="id" value="<?= $task->getId() ?>">
          <input type="text" name="title" placeholder="New Title">
          <input type="text" name="description" placeholder="New Description">
          <label>
            <input type="checkbox" name="completed" <?= $task->isCompleted() ? 'checked' : '' ?>>
            Completed
          </label>
          <button type="submit" name="edit-task">Edit</button>
          <button type="submit" name="delete-task">Delete</button>
        </form>
      </li>
    <?php endforeach; ?>
  </ul>
</body>
</html>
