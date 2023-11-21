<?php

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\PostController;

define('APP_DIRECTORY', __DIR__ . '/../');

require_once '../vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(APP_DIRECTORY);
$dotenv->load();

$app = new App\Application();

$app->route->addRoute('GET','/home',[HomeController::class, 'index']);
$app->route->addRoute('GET','/posts',[PostController::class, 'index'],['auth']);
$app->route->addRoute('GET','/login',[LoginController::class, 'login']);
$app->route->addRoute('POST','/login',[LoginController::class, 'loginPost']);

$app->run();












