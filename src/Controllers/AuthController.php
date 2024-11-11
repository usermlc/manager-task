<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use App\Service\UserService;
use PDO;

class AuthController
{
    private PDO $db; // Database connection
    private UserService $userService; // Service to handle user-related operations

    // Constructor to initialize the database connection and user service
    public function __construct(PDO $db, UserService $userService)
    {
        $this->db = $db;
        $this->userService = $userService;
    }

    // Method to register a new user
    public function register(array $data): void
    {
        try {
            $this->userService->register($data); // Call the register method from UserService
            echo "User registered successfully!"; // Success message
        } catch (\Exception $e) {
            echo "Registration failed: " . $e->getMessage(); // Error message
        }
    }

    // Method for user login
    public function login(array $data): void
    {
        try {
            $userId = $this->userService->login($data['username'], $data['password']); // Attempt to log in user
            if ($userId !== null) {
                $_SESSION['user_id'] = $userId; // Store user ID in session
                echo "Login successful!"; // Success message
            } else {
                echo "Invalid username or password."; // Error message for invalid credentials
            }
        } catch (\Exception $e) {
            echo "Login failed: " . $e->getMessage(); // Error message
        }
    }

    // Method to change user's password
    public function changePassword(int $userId, string $newPassword): void
    {
        try {
            $this->userService->changePassword($userId, $newPassword); // Call the changePassword method from UserService
            echo "Password updated successfully!"; // Success message
        } catch (\Exception $e) {
            echo "Password update failed: " . $e->getMessage(); // Error message
        }
    }

    // Method for user logout
    public function logout(): void
    {
        try {
            session_unset(); // Unset all session variables
            session_destroy(); // Destroy the session
            echo "User logged out successfully!"; // Success message
        } catch (\Exception $e) {
            echo "Logout failed: " . $e->getMessage(); // Error message
        }
    }
}
