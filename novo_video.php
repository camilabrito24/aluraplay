<?php

use Alura\Mvc\Repository\VideoRepository;

$dbPath = __DIR__.'/banco.sqlite';
$pdo =  new PDO("sqlite:$dbPath");

$url = filter_input(INPUT_POST,'url',FILTER_VALIDATE_URL);
$title = filter_input(INPUT_POST,'titulo');

if($url === false || $title === false) {
    header('Location: /?sucesso=0');
    exit();
}

$repository = new VideoRepository($pdo);
$result = $repository->add(new \Alura\Mvc\Entity\Video($url,$title));

if($result === false){
    header('Location: /?sucesso=0');
} else {
    header('Location: /?sucesso=2');
}
