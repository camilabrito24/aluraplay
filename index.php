<?php

declare(strict_types=1);


if($_SERVER["PATH_INFO"] === '/' || !array_key_exists("PATH_INFO", $_SERVER)){
    require_once 'listagem_videos.php';
} else if ($_SERVER["PATH_INFO"] === '/novo_video'){
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        require_once 'novo_video.php';
    }else if ($_SERVER["REQUEST_METHOD"] === 'GET'){
        require_once 'formulario.php';
    }
} else if($_SERVER["PATH_INFO"] === '/editar_video'){
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        require_once 'editar_video.php';
    }else if ($_SERVER["REQUEST_METHOD"] === 'GET'){
        require_once 'formulario.php';
    }
} else if($_SERVER["PATH_INFO"] === '/remover_video'){
    require_once 'remover_video.php';
}