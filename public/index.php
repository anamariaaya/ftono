<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AuthController;
use Controllers\PublicController;
use Controllers\DashboardController;


$router = new Router();

// Iniciar Sesión
$router->get('/', [PublicController::class, 'index']);
$router->get('/search', [PublicController::class, 'search']);
$router->get('/cart', [PublicController::class, 'cart']);
$router->get('/categories', [PublicController::class, 'categories']);
$router->get('/help', [PublicController::class, 'help']);
$router->get('/faq', [PublicController::class, 'faq']);
$router->get('/artists', [PublicController::class, 'artists']);

//Auth Usuarios
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'registro']);

//Dashboard Editoriales/Publishers
$router->get('/dashboard', [DashboardController::class, 'index']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();