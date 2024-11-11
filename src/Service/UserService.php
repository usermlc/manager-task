<?php
declare(strict_types=1);

namespace App\Service;

use App\Models\User;
use PDO;

class UserService
{
    private PDO $db; // Database connection

    // Constructor to initialize the database connection
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Method to register a new user
    public function register(array $data): bool
    {
        $user = new User($this->db, $data['username'], $data['email'], $data['password']);
        return $user->register(); // Call the register method from User model
    }

    // Method for user login
    public function login(string $username, string $password): int
    {
        $user = new User($this->db, $username, '', '');
        if ($user->login($username, $password)) {
            return $user->getId(); // Return user ID if login is successful
        }
        throw new \Exception('Invalid username or password'); // Throw exception if login fails
    }

    // Method to change user's password
    public function changePassword(int $userId, string $newPassword): bool
    {
        $user = new User($this->db, '', '', '');
        $user->setId($userId); // Set the user ID for updating the password
        return $user->changePassword($newPassword); // Call the changePassword method from User model
    }
}
