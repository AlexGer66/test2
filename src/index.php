<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['task'])) {
    $stmt = $pdo->prepare('INSERT INTO tasks (description) VALUES (?)');
    $stmt->execute([$_POST['task']]);
    header('Location: /');
    exit;
}

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = ?');
    $stmt->execute([$_GET['delete']]);
    header('Location: /');
    exit;
}

$tasks = $pdo->query('SELECT * FROM tasks ORDER BY id DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Todo list</title>
</head>
<body>
<h1>Todo list</h1>
<form method="post">
    <input type="text" name="task" required>
    <button type="submit">Add</button>
</form>
<ul>
<?php foreach ($tasks as $task): ?>
    <li>
        <?= htmlspecialchars($task['description']) ?>
        <a href="?delete=<?= $task['id'] ?>">[delete]</a>
    </li>
<?php endforeach; ?>
</ul>
</body>
</html>
