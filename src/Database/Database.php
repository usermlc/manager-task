<?php
declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private PDO $connection; // PDO instance for database connection

    // Constructor to initialize the database connection
    public function __construct(string $dsn, string $username, string $password)
    {
        try {
            // Create a new PDO instance
            $this->connection = new PDO($dsn, $username, $password);
            // Set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Handle connection failure
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Method to get the PDO connection instance
    public function getConnection(): PDO
    {
        return $this->connection;
    }

    // Method to close the database connection
    public function close(): void
    {
        $this->connection = null; // Nullify the PDO instance
    }
}
