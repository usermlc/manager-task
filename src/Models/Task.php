<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class Task
{
    private int $id; // Task ID
    private string $title; // Task title
    private ?string $description; // Task description (nullable)
    private string $status; // Task status
    private int $creatorId; // ID of the user who created the task
    private ?int $assignedToId; // ID of the user to whom the task is assigned (nullable)
    private \DateTimeImmutable $createdAt; // Task creation timestamp
    private \DateTimeImmutable $updatedAt; // Task update timestamp
    private PDO $db; // Database connection

    // Constructor to initialize task properties and set creation/update timestamps
    public function __construct(
        PDO $db,
        string $title,
        ?string $description,
        string $status,
        int $creatorId,
        ?int $assignedToId = null
    ) {
        $this->db = $db;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->creatorId = $creatorId;
        $this->assignedToId = $assignedToId;
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    // Method to create a new task in the database
    public function create(): bool
    {
        $sql = "INSERT INTO tasks (title, description, status, creator_id, assigned_to_id, created_at, updated_at)
                VALUES (:title, :description, :status, :creator_id, :assigned_to_id, :created_at, :updated_at)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title' => $this->title,
            ':description' => $this->description,
            ':status' => $this->status,
            ':creator_id' => $this->creatorId,
            ':assigned_to_id' => $this->assignedToId,
            ':created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            ':updated_at' => $this->updatedAt->format('Y-m-d H:i:s'),
        ]);
    }

    // Method to update an existing task in the database
    public function update(): bool
    {
        $this->updatedAt = new \DateTimeImmutable();
        $sql = "UPDATE tasks SET title = :title, description = :description, status = :status, updated_at = :updated_at 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title' => $this->title,
            ':description' => $this->description,
            ':status' => $this->status,
            ':updated_at' => $this->updatedAt->format('Y-m-d H:i:s'),
            ':id' => $this->id,
        ]);
    }

    // Method to delete a task from the database
    public function delete(): bool
    {
        $sql = "DELETE FROM tasks WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $this->id]);
    }

    // Method to assign a task to a user
    public function assignTo(int $userId): bool
    {
        $this->assignedToId = $userId;
        $sql = "UPDATE tasks SET assigned_to_id = :assigned_to_id WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':assigned_to_id' => $userId,
            ':id' => $this->id,
        ]);
    }

    // Method to change the status of a task
    public function changeStatus(string $newStatus): bool
    {
        $this->status = $newStatus;
        $sql = "UPDATE tasks SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':status' => $newStatus,
            ':id' => $this->id,
        ]);
    }

    // Getter method for task ID
    public function getId(): int
    {
        return $this->id;
    }

    // Getter method for task title
    public function getTitle(): string
    {
        return $this->title;
    }

    // Getter method for task description
    public function getDescription(): ?string
    {
        return $this->description;
    }

    // Getter method for task status
    public function getStatus(): string
    {
        return $this->status;
    }

    // Getter method for task creator ID
    public function getCreatorId(): int
    {
        return $this->creatorId;
    }

    // Getter method for the ID of the user to whom the task is assigned
    public function getAssignedToId(): ?int
    {
        return $this->assignedToId;
    }
}
