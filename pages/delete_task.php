<?php
require_once '../includes/functions.php';

// Получение задачи по ID
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: home.php');
    exit();
}

// Удаление задачи
deleteTask($pdo, $id);

// Перенаправление на главную страницу после удаления
header('Location: home.php');
exit();
?>
