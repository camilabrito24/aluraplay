<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

if(!array_key_exists("PATH_INFO", $_SERVER) || $_SERVER["PATH_INFO"] === '/'){
    require_once __DIR__ . '/../listagem_videos.php';
} else if ($_SERVER["PATH_INFO"] === '/novo_video'){
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        require_once __DIR__ . '/../novo_video.php';
    }else if ($_SERVER["REQUEST_METHOD"] === 'GET'){
        require_once __DIR__ . '/../formulario.php';
    }
} else if($_SERVER["PATH_INFO"] === '/editar_video'){
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        require_once __DIR__ . '/../editar_video.php';
    }else if ($_SERVER["REQUEST_METHOD"] === 'GET'){
        require_once __DIR__ . '/../formulario.php';
    }
} else if($_SERVER["PATH_INFO"] === '/remover_video'){
    require_once __DIR__ . '/../remover_video.php';
} else {
    http_response_code(404);
}