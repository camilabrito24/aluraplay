<?php

use Alura\Mvc\Entity\Video;

$dbPath = __DIR__.'/banco.sqlite';
$pdo =  new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false && $id === null){
    header('Location: /?sucesso=0');
    exit();
}

$url = filter_input(INPUT_POST,'url',FILTER_VALIDATE_URL);
$title = filter_input(INPUT_POST,'titulo');

if($url === false || $title === false) {
    header('Location: /?sucesso=0');
    exit();
}

$video = new Video($url,$title);
$video->setId($id);

$repository = new \Alura\Mvc\Repository\VideoRepository($pdo);
$result = $repository->update($video);

if($result === false){
    header('Location: /?sucesso=0');
} else {
    header('Location: /?sucesso=3');
}