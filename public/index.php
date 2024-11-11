<?php
declare(strict_types=1);

use App\Core\Router;

require_once '../vendor/autoload.php';

// Create a new Router instance
$router = new Router();

// Set a handler for not found pages
$router->setNotFoundHandler(function () {
    echo '404 - Page not found';
});

// Register GET route for the register page
$router->get('/register', function () {
    include '../src/views/register.php'; // Include the register view
});

// Register POST route for user registration
$router->post('/register', function () {
    echo 'Registering user...';
});

// Register GET route for the login page
$router->get('/login', function () {
    include '../src/views/login.php'; // Include the login view
});

// Register POST route for user login
$router->post('/login', function () {
    echo 'Logging in...';
});

// Register GET route for the change password page
$router->get('/change-password', function () {
    include '../src/views/change-password.php'; // Include the change password view
});

// Register POST route for changing password
$router->post('/change-password', function () {
    echo 'Changing password...';
});

// Register GET route to display tasks
$router->get('/tasks', function () {
    $tasks = [
        ['id' => 1, 'title' => 'Task 1', 'description' => 'Description 1', 'status' => 'In Progress', 'assigned_to_id' => 2],
    ];
    include '../src/views/tasks.php'; // Include the tasks view
});

// Register POST route for creating a new task
$router->post('/task/create', function () {
    echo 'Creating task...';
});

// Register GET route for editing a task by ID
$router->get('/tasks/edit/{id}', function ($id) {
    echo 'Editing task with ID: ' . $id;
});

// Register GET route for deleting a task by ID
$router->get('/tasks/delete/{id}', function ($id) {
    echo 'Deleting task with ID: ' . $id;
});

// Dispatch the request based on method and URI
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
