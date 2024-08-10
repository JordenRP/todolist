<?php
require_once 'database.php';

// Получение всех задач
function getTasks($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM tasks ORDER BY due_date ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Добавление новой задачи
function addTask($pdo, $title, $description, $due_date, $priority) {
    $stmt = $pdo->prepare("INSERT INTO tasks (title, description, due_date, priority) VALUES (:title, :description, :due_date, :priority)");
    $stmt->execute(['title' => $title, 'description' => $description, 'due_date' => $due_date, 'priority' => $priority]);
}

// Получение задачи по ID
function getTaskById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Обновление задачи
function updateTask($pdo, $id, $title, $description, $due_date, $priority, $status) {
    $stmt = $pdo->prepare("UPDATE tasks SET title = :title, description = :description, due_date = :due_date, priority = :priority, status = :status WHERE id = :id");
    $stmt->execute(['title' => $title, 'description' => $description, 'due_date' => $due_date, 'priority' => $priority, 'status' => $status, 'id' => $id]);
}

// Удаление задачи
function deleteTask($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
    $stmt->execute(['id' => $id]);
}
?>
