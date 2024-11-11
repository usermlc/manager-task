<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Service\TaskService;
use PDO;

class TaskController
{
    private PDO $db; // Database connection
    private TaskService $taskService; // Service to handle task-related operations

    // Constructor to initialize the database connection and task service
    public function __construct(PDO $db, TaskService $taskService)
    {
        $this->db = $db;
        $this->taskService = $taskService;
    }

    // Method to create a new task
    public function create(array $data): void
    {
        try {
            $this->taskService->createTask($data); // Call the createTask method from TaskService
            echo "Task created successfully!"; // Success message
        } catch (\Exception $e) {
            echo "Task creation failed: " . $e->getMessage(); // Error message
        }
    }

    // Method to update an existing task
    public function update(int $taskId, array $data): void
    {
        try {
            $this->taskService->updateTask($taskId, $data); // Call the updateTask method from TaskService
            echo "Task updated successfully!"; // Success message
        } catch (\Exception $e) {
            echo "Task update failed: " . $e->getMessage(); // Error message
        }
    }

    // Method to delete an existing task
    public function delete(int $taskId): void
    {
        try {
            $this->taskService->deleteTask($taskId); // Call the deleteTask method from TaskService
            echo "Task deleted successfully!"; // Success message
        } catch (\Exception $e) {
            echo "Task deletion failed: " . $e->getMessage(); // Error message
        }
    }

    // Method to get tasks by user ID
    public function getTasksByUser(int $userId): void
    {
        try {
            $tasks = $this->taskService->getTasksByUser($userId); // Call the getTasksByUser method from TaskService
            echo json_encode($tasks); // Encode the tasks array as JSON and output it
        } catch (\Exception $e) {
            echo "Failed to retrieve tasks: " . $e->getMessage(); // Error message
        }
    }
}
