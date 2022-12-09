<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\APIController;
use Controllers\AuthController;
use Controllers\PublicController;

use Controllers\Filmtono\DashboardController;
use Controllers\Filmtono\ProfileController;
use Controllers\Filmtono\PromosController;
use Controllers\Filmtono\UsersController;
use Controllers\Filmtono\LabelsController;
use Controllers\Filmtono\CategoriesController;
use Controllers\Filmtono\AlbumsController;
use Controllers\Filmtono\ArtistsController;
use Controllers\Filmtono\KeywordsController;
use Controllers\Filmtono\PaymentsController;
use Controllers\Filmtono\ContractsController;


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
$router->get('/music/dashboard', [DashboardController::class, 'musica']);
$router->get('/music/profile', [DashboardController::class, 'profile']);
$router->get('/music/labels', [DashboardController::class, 'profile']);

//Dashboard Compradores/Buyers
$router->get('/compras/dashboard', [DashboardController::class, 'compras']);
$router->get('/compras/profile', [DashboardController::class, 'profile']);

//Dashboard Filmtono
$router->get('/filmtono/dashboard', [DashboardController::class, 'index']);

//Filmtono Profile
$router->get('/filmtono/profile', [ProfileController::class, 'profile']);
$router->post('/filmtono/profile', [ProfileController::class, 'profile']);
$router->post('/filmtono/profile/delete', [ProfileController::class, 'delete']);

//Filmtono Promos
$router->get('/filmtono/promos', [PromosController::class, 'index']);

//Filmtono Users
$router->get('/filmtono/users', [UsersController::class, 'index']);

//Filmtono Labels
$router->get('/filmtono/labels', [LabelsController::class, 'index']);

//Filmtono Categories
$router->get('/filmtono/categories', [CategoriesController::class, 'index']);

//Filmtono Albums
$router->get('/filmtono/albums', [AlbumsController::class, 'index']);

//Filmtono Artists
$router->get('/filmtono/artists', [ArtistsController::class, 'index']);

//Filmtono Keywords
$router->get('/filmtono/keywords', [KeywordsController::class, 'index']);

//Filmtono Payments
$router->get('/filmtono/payments', [PaymentsController::class, 'index']);

//Filmtono Contracts
$router->get('/filmtono/contracts', [ContractsController::class, 'index']);

//API Controllers
$router->post('/api/profile', [APIController::class, 'profile']);
$router->post('/api/profile/status', [APIController::class, 'profileStatus']);
$router->post('/api/profile/sellos', [APIController::class, 'profileSellos']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();

