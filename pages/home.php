<?php
require_once '../includes/functions.php';

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $due_date = $_POST['due_date'] ?? '';
    $priority = $_POST['priority'] ?? 1;

    addTask($pdo, $title, $description, $due_date, $priority);
    header('Location: home.php');
    exit();
}

// Получение всех задач
$tasks = getTasks($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>To-Do List</h1>

        <section>
            <h2>Добавить задачу</h2>
            <form method="POST" action="/pages/home.php">
                <label for="title">Название:</label>
                <input type="text" id="title" name="title" required>

                <label for="description">Описание:</label>
                <textarea id="description" name="description"></textarea>

                <label for="due_date">Дата выполнения:</label>
                <input type="date" id="due_date" name="due_date" required>

                <label for="priority">Приоритет:</label>
                <select id="priority" name="priority">
                    <option value="1">Низкий</option>
                    <option value="2">Средний</option>
                    <option value="3">Высокий</option>
                </select>

                <button type="submit">Добавить задачу</button>
            </form>
        </section>

        <section>
            <h2>Список задач</h2>
            <ul>
                <?php foreach ($tasks as $task): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($task['title']); ?></strong>
                        <p><?php echo htmlspecialchars($task['description']); ?></p>
                        <p>Дата выполнения: <?php echo htmlspecialchars($task['due_date']); ?></p>
                        <p>Приоритет: <?php echo htmlspecialchars($task['priority']); ?></p>
                        <p>Статус: <?php echo htmlspecialchars($task['status']); ?></p>
                        <a href="edit_task.php?id=<?php echo $task['id']; ?>">Редактировать</a>
                        <a href="delete_task.php?id=<?php echo $task['id']; ?>">Удалить</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
