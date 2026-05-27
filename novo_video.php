<?php

$_caminho = __DIR__.'/banco.sqlite';
$pdo =  new PDO("sqlite:$_caminho");

$_url = filter_input(INPUT_POST,'url',FILTER_VALIDATE_URL);
$_titulo = filter_input(INPUT_POST,'titulo');

if($_url === false || $_titulo === false) {
    header('Location: /index.php?sucesso=0');
    exit();
}

$sql = "INSERT INTO videos (url, title) VALUES(?, ?)";
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $_url);
$statement->bindValue(2, $_titulo);

if($statement->execute() === false){
    header('Location: /index.php?sucesso=0');
} else {
    header('Location: /index.php?sucesso=2');
}
