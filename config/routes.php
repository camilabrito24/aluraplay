<?php

declare(strict_types=1);

return [
    'GET|/' => \Alura\Mvc\Controller\VideoListController::class,
    'GET|/novo_video' => \Alura\Mvc\Controller\VideoFormController::class,
    'POST|/novo_video' => \Alura\Mvc\Controller\NewVideoController::class,
    'GET|/editar_video' => \Alura\Mvc\Controller\VideoFormController::class,
    'POST|/editar_video' => \Alura\Mvc\Controller\VideoUpdateController::class,
    'GET|/remover_video' => \Alura\Mvc\Controller\VideoRemoveController::class,
    ];