<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\UsuarioController;
use App\Middleware\AuthMiddleware;
use App\Application;

$app = new Application();
$router = $app->getRouter();

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/

$router->get(
    '/',
    [AuthController::class, 'login']
);

$router->get(
    '/login',
    [AuthController::class, 'login']
);

$router->post(
    '/autenticar',
    [AuthController::class, 'autenticar']
);
/*
$router->get(
    '/sobre',
    [HomeController::class, 'sobre']
);
*/

/*
|--------------------------------------------------------------------------
| Rotas Protegidas
|--------------------------------------------------------------------------
*/

$router->get(
    '/dashboard',
    [DashboardController::class, 'index'],
    [AuthMiddleware::class,SessionMiddleware::class]
);

$router->get(
    '/usuarios',
    [UsuarioController::class, 'listar'],
    [AuthMiddleware::class,SessionMiddleware::class]
);

$router->post(
    '/usuarios',
    [UsuarioController::class, 'salvar'],
    [AuthMiddleware::class,SessionMiddleware::class]
);

$router->get(
    '/logout',
    [AuthController::class, 'logout'],
    [AuthMiddleware::class]
);