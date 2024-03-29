<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AuthController;
use Controllers\PublicController;
use Controllers\DashboardController;
use Controllers\APIProfileController;

use Controllers\Music\CompanyController;
use Controllers\Filmtono\UsersController;
use Controllers\Filmtono\AlbumsController;
use Controllers\Filmtono\GenresController;
use Controllers\Filmtono\LabelsController;
use Controllers\Filmtono\PromosController;
use Controllers\Music\APIArtistController;
use Controllers\Filmtono\ArtistsController;
use Controllers\Filmtono\ProfileController;
use Controllers\Filmtono\APIUsersController;
use Controllers\Filmtono\KeywordsController;
use Controllers\Filmtono\PaymentsController;


use Controllers\Music\MusicAlbumsController;
use Controllers\Music\MusicLabelsController;
use Controllers\Filmtono\ContractsController;
use Controllers\Music\MusicArtistsController;


use Controllers\Music\MusicProfileController;
use Controllers\Filmtono\CategoriesController;
use Controllers\Clients\ClientProfileController;


$router = new Router();
session_start();

// Iniciar Sesión
$router->get('/', [PublicController::class, 'index']);
$router->get('/category', [PublicController::class, 'category']);
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
$router->get('/complete-register', [AuthController::class, 'completeRegister']);
$router->post('/complete-register', [AuthController::class, 'completeRegister']);

//Dashboard Editoriales/Publishers
$router->get('/music/dashboard', [DashboardController::class, 'music']);
$router->get('/music/profile', [MusicProfileController::class, 'index']);
$router->post('/music/profile', [MusicProfileController::class, 'index']);
$router->get('/music/labels', [MusicLabelsController::class, 'index']);
$router->get('/music/labels/new', [MusicLabelsController::class, 'new']);
$router->post('/music/labels/new', [MusicLabelsController::class, 'new']);
$router->get('/music/labels/update', [MusicLabelsController::class, 'update']);
$router->post('/music/labels/update', [MusicLabelsController::class, 'update']);
$router->post('/music/labels/delete', [MusicLabelsController::class, 'delete']);
$router->get('/music/albums', [MusicAlbumsController::class, 'index']);
$router->get('/music/albums/current', [MusicAlbumsController::class, 'current']);
$router->get('/music/albums/new', [MusicAlbumsController::class, 'new']);
$router->post('/music/albums/new', [MusicAlbumsController::class, 'new']);
$router->post('/music/albums/edit', [MusicAlbumsController::class, 'update']);
$router->get('/music/albums/song/new', [MusicAlbumsController::class, 'newSong']);
$router->get('/music/artists', [MusicArtistsController::class, 'index']);

$router->get('/music/company', [CompanyController::class, 'index']);
$router->post('/music/company', [CompanyController::class, 'index']);
$router->get('/music/company/contracts', [CompanyController::class, 'contracts']);
$router->get('/music/company/delete', [CompanyController::class, 'delete']);

//Dashboard Compradores/Clients
$router->get('/clients/dashboard', [DashboardController::class, 'clients']);
$router->get('/clients/profile', [ClientProfileController::class, 'profile']);

//Dashboard Filmtono
$router->get('/filmtono/dashboard', [DashboardController::class, 'admin']);

//Filmtono APIs
$router->get('/api/filmtono/users', [APIUsersController::class, 'index']);
$router->get('/api/filmtono/lenguaje', [APIProfileController::class, 'lenguaje']);
$router->get('/api/filmtono/alerts', [APIProfileController::class, 'alerts']);
$router->get('/api/filmtono/contracts', [APIProfileController::class, 'contracts']);
$router->post('/api/filmtono/signature', [APIProfileController::class, 'signatures']);
$router->get('/api/filmtono/c-musical', [APIProfileController::class, 'contratoMusical']);
$router->get('/api/filmtono/c-artistico', [APIProfileController::class, 'contratoArtistico']);
$router->post('/api/albums/artistasNew', [APIArtistController::class, 'artistaNuevo']);



//Filmtono Profile
$router->get('/filmtono/profile', [ProfileController::class, 'profile']);
$router->post('/filmtono/profile', [ProfileController::class, 'profile']);
$router->post('/filmtono/profile/delete', [ProfileController::class, 'delete']);


//Filmtono Promos
$router->get('/filmtono/promos', [PromosController::class, 'index']);
$router->get('/filmtono/promos/new', [PromosController::class, 'new']);
$router->post('/filmtono/promos/new', [PromosController::class, 'new']);
$router->get('/filmtono/promos/edit', [PromosController::class, 'edit']);
$router->post('/filmtono/promos/edit', [PromosController::class, 'edit']);
$router->post('/filmtono/promos/delete', [PromosController::class, 'delete']);

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

//Filmtono Genres
$router->get('/filmtono/genres', [GenresController::class, 'index']);
$router->get('/filmtono/genres/new', [GenresController::class, 'new']);
$router->post('/filmtono/genres/new', [GenresController::class, 'new']);
$router->get('/filmtono/genres/edit', [GenresController::class, 'edit']);
$router->post('/filmtono/genres/edit', [GenresController::class, 'edit']);
$router->post('/filmtono/genres/delete', [GenresController::class, 'delete']);

//Filmtono Keywords
$router->get('/filmtono/keywords', [KeywordsController::class, 'index']);

//Filmtono Payments
$router->get('/filmtono/payments', [PaymentsController::class, 'index']);

//Filmtono Contracts
$router->get('/filmtono/contracts', [ContractsController::class, 'index']);
$router->get('/filmtono/contracts/current', [ContractsController::class, 'current']);
$router->get('/api/filmtono/contracts', [ContractsController::class, 'contratos']);
$router->get('/filmtono/contracts/delete', [ContractsController::class, 'delete']);


//API Controllers
$router->post('/api/profile', [APIProfileController::class, 'profile']);
$router->post('/api/profile/status', [APIProfileController::class, 'profileStatus']);
$router->post('/api/profile/sellos', [APIProfileController::class, 'profileSellos']);

//debugging($router);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();



