<?php

declare(strict_types=1);

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
$videoRepository = new VideoRepository($pdo);

/** @var Controller $controller */

if(!array_key_exists("PATH_INFO", $_SERVER) || $_SERVER["PATH_INFO"] === '/'){
    $controller = new VideoListController($videoRepository);
} else if ($_SERVER["PATH_INFO"] === '/novo_video'){
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        $controller = new NewVideoController($videoRepository);
    }else if ($_SERVER["REQUEST_METHOD"] === 'GET'){
        $controller = new VideoFormController($videoRepository);
    }
} else if($_SERVER["PATH_INFO"] === '/editar_video'){
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        $controller = new VideoUpdateController($videoRepository);
    }else if ($_SERVER["REQUEST_METHOD"] === 'GET'){
        $controller = new VideoFormController($videoRepository);
    }
} else if($_SERVER["PATH_INFO"] === '/remover_video'){
    $controller = new VideoRemoveController($videoRepository);
} else {
    $controller = new Error404Controller();
}

$controller->processaRequisicao();