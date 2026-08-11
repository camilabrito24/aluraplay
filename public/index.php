<?php

declare(strict_types=1);

use Alura\Mvc\Repository\UserRepository;
use Alura\Mvc\Controller\{
    Error404Controller,
    VideoFormController,
    VideoRemoveController,
    VideoListController,
    NewVideoController,
    VideoUpdateController,
    Controller
};
use Alura\Mvc\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$routes = require_once __DIR__ . '/../config/routes.php';
$pathInfo = $_SERVER["PATH_INFO"] ?? '/';
$requestMethod = $_SERVER["REQUEST_METHOD"];

if($pathInfo == '/login'){
    $repository = new UserRepository($pdo);
} else {
    $repository = new VideoRepository($pdo);
}

if(array_key_exists("$requestMethod|$pathInfo", $routes)){
    $controllerClass = $routes["$requestMethod|$pathInfo"];
    $controller = new $controllerClass($repository);
} else {
    $controller = new Error404Controller();
}

/** @var Controller $controller */
$controller->processaRequisicao();