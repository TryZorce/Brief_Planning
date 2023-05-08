<?php
require_once('Task.php');
require_once('TaskManager.php');

$taskManager = new TaskManager('localhost', 'planning', 'root', 'root');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['add-task'])) {
    $taskManager->addTask($_POST['title'], $_POST['description']);
  } elseif (isset($_POST['delete-task'])) {
    $taskManager->deleteTask($_POST['id']);
  } elseif (isset($_POST['edit-task'])) {
    $taskManager->editTask($_POST['id'], $_POST['title'], $_POST['description'], $_POST['completed']);
  }
}

$tasks = $taskManager->getAllTasks();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Task Manager</title>
</head>
<body>
  <h1>Task Manager</h1>
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
        <?php echo $task->getTitle(); ?> - <?php echo $task->getDescription(); ?>
        <form method="post">
          <input type="hidden" name="id" value="<?php echo $task->getId(); ?>">
          <input type="text" name="title" placeholder="New Title">
          <input type="text" name="description" placeholder="New Description">
          <button type="submit" name="edit-task">Edit</button>
          <button type="submit" name="delete-task">Delete</button>
        </form>
      </li>
    <?php endforeach; ?>
  </ul>
</body>
</html>

