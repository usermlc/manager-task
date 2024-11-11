<?php
declare(strict_types=1);

namespace App\Service;

use App\Models\Task;
use PDO;

class TaskService
{
    private PDO $db; // Database connection

    // Constructor to initialize the database connection
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Method to create a new task
    public function createTask(array $data): bool
    {
        $task = new Task(
            $this->db,
            $data['title'],
            $data['description'] ?? null,
            $data['status'] ?? 'pending',
            $data['creator_id']
        );
        return $task->create(); // Call the create method from Task model
    }

    // Method to update an existing task
    public function updateTask(int $taskId, array $data): bool
    {
        $task = new Task($this->db, $data['title'], $data['description'], $data['status'], $data['creator_id']);
        $task->setId($taskId); // Set the task ID for updating
        return $task->update(); // Call the update method from Task model
    }

    // Method to delete a task
    public function deleteTask(int $taskId): bool
    {
        $task = new Task($this->db, '', null, '', 0); // Temporary Task object to call delete method
        $task->setId($taskId); // Set the task ID for deletion
        return $task->delete(); // Call the delete method from Task model
    }

    // Method to get tasks by user ID
    public function getTasksByUser(int $userId): array
    {
        $sql = "SELECT * FROM tasks WHERE creator_id = :user_id OR assigned_to_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all tasks assigned to or created by the user
    }
}
