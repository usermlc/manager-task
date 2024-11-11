# Task Manager

## Description
This project is a web application designed to manage user accounts and tasks. It provides essential features such as user registration, login, password management, and task management. The project aims to streamline and simplify the process of handling user information and their associated tasks, ensuring a smooth user experience and efficient task handling.

## Features
- User registration and login
- Task creation, update, deletion
- Change password functionality
- Display of tasks assigned to or created by the user

## Technologies Used
- PHP
- PDO for database interactions
- HTML/CSS for front-end

## Installation
1. Navigate to the project directory:
    ```sh
    cd manage-task
    ```

2. Install dependencies using Composer:
    ```sh
    composer install
    ```

3. Configure the database connection in `src/Core/Database.php`:
    ```php
    $dsn = 'mysql:host=your_host;dbname=your_db;charset=utf8';
    $username = 'your_username';
    $password = 'your_password';
    ```

4. Run the project:
    ```sh
    php -S localhost:8000 -t public
    ```

5. Open your browser and navigate to `http://localhost:8000`.

## Usage
### User Registration
Navigate to `/register` to create a new user.

### User Login
Navigate to `/login` to log in as an existing user.

### Change Password
Navigate to `/change-password` to update your password.

### Task Management
- View tasks at `/tasks`
- Create a new task using the form provided on the tasks page
- Edit or delete tasks using the provided actions

## Project Structure
```
.
├── public
│   ├── index.php
│   └── .htaccess
├── src
│   ├── Core
│   │   ├── Database.php
│   │   └── Router.php
│   ├── Controllers
│   │   ├── AuthController.php
│   │   └── TaskController.php
│   ├── Models
│   │   ├── User.php
│   │   └── Task.php
│   ├── Service
│   │   ├── UserService.php
│   │   └── TaskService.php
│   └── views
│       ├── register.php
│       ├── login.php
│       ├── change-password.php
│       └── tasks.php
└── vendor
```

## Contributing
1. Create a new branch (`git checkout -b feature-branch`).
2. Make your changes and commit them (`git commit -m 'Add some feature'`).
3. Push to the branch (`git push origin feature-branch`).
4. Open a Pull Request.

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
