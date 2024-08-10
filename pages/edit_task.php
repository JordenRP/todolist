<?php
require_once '../includes/functions.php';

// Получение задачи по ID
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: home.php');
    exit();
}

$task = getTaskById($pdo, $id);
if (!$task) {
    header('Location: home.php');
    exit();
}

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $due_date = $_POST['due_date'] ?? '';
    $priority = $_POST['priority'] ?? 1;
    $status = $_POST['status'] ?? 'pending';

    updateTask($pdo, $id, $title, $description, $due_date, $priority, $status);
    header('Location: home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать задачу</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Редактировать задачу</h1>

        <form method="POST" action="edit_task.php?id=<?php echo $id; ?>">
            <label for="title">Название:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>

            <label for="description">Описание:</label>
            <textarea id="description" name="description"><?php echo htmlspecialchars($task['description']); ?></textarea>

            <label for="due_date">Дата выполнения:</label>
            <input type="date" id="due_date" name="due_date" value="<?php echo htmlspecialchars($task['due_date']); ?>" required>

            <label for="priority">Приоритет:</label>
            <select id="priority" name="priority">
                <option value="1" <?php echo $task['priority'] == 1 ? 'selected' : ''; ?>>Низкий</option>
                <option value="2" <?php echo $task['priority'] == 2 ? 'selected' : ''; ?>>Средний</option>
                <option value="3" <?php echo $task['priority'] == 3 ? 'selected' : ''; ?>>Высокий</option>
            </select>

            <label for="status">Статус:</label>
            <select id="status" name="status">
                <option value="pending" <?php echo $task['status'] == 'pending' ? 'selected' : ''; ?>>В ожидании</option>
                <option value="completed" <?php echo $task['status'] == 'completed' ? 'selected' : ''; ?>>Выполнено</option>
            </select>

            <button type="submit">Сохранить изменения</button>
        </form>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
