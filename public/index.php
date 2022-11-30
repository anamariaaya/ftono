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
$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'register']);
$router->get('/register-music', [AuthController::class, 'registerMusic']);
$router->post('/register-music', [AuthController::class, 'registerMusic']);
$router->get('/message', [AuthController::class, 'message']);
$router->get('/confirm-account', [AuthController::class, 'confirm']);
$router->get('/forgot-password', [AuthController::class, 'forgot']);
$router->post('/forgot-password', [AuthController::class, 'forgot']);
$router->get('/reset-password', [AuthController::class, 'reset']);
$router->post('/reset-password', [AuthController::class, 'reset']);
$router->post('/logout', [AuthController::class, 'logout']);

//Dashboard Editoriales/Publishers
$router->get('/filmtono/dashboard', [DashboardController::class, 'index']);
$router->get('/compras/dashboard', [DashboardController::class, 'compras']);
$router->get('/musica/dashboard', [DashboardController::class, 'musica']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();

