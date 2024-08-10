CREATE DATABASE IF NOT EXISTS todo_list;

USE todo_list;

CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    due_date DATE,
    priority INT,
    status ENUM('pending', 'completed') DEFAULT 'pending'
);
