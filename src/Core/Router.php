<?php
declare(strict_types=1);

namespace App\Core;

use Closure;

class Router
{
    protected array $routes = []; // Array to store routes
    protected ?Closure $notFoundHandler = null; // Handler for not found routes

    // Method to add a GET route
    public function get(string $path, callable $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    // Method to add a POST route
    public function post(string $path, callable $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    // Method to add a route to the routes array
    protected function addRoute(string $method, string $path, callable $handler): void
    {
        $this->routes[$method][$path] = $handler;
    }

    // Method to set a handler for not found routes
    public function setNotFoundHandler(Closure $handler): void
    {
        $this->notFoundHandler = $handler;
    }

    // Method to dispatch a route based on method and URI
    public function dispatch(string $method, string $uri): void
    {
        $uri = parse_url($uri, PHP_URL_PATH); // Parse the URI to get the path

        if (isset($this->routes[$method][$uri])) {
            // Call the handler for the matched route
            call_user_func($this->routes[$method][$uri]);
        } else {
            if ($this->notFoundHandler) {
                // Call the not found handler if set
                call_user_func($this->notFoundHandler);
            } else {
                // Send a 404 response if no handler is found
                header("HTTP/1.0 404 Not Found");
                echo "404 Not Found";
            }
        }
    }
}
