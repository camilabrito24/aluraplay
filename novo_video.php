<?php

$_caminho = __DIR__.'/banco.sqlite';
$pdo =  new PDO("sqlite:$_caminho");

$_url = filter_input(INPUT_POST,'url',FILTER_VALIDATE_URL);
if($_url === false) {
    header('Location: /index.php?sucesso=0');
    exit();
}
$_titulo = filter_input($_POST['titulo']);


$sql = "INSERT INTO videos (url, title) VALUES(?, ?)";
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $_url);
$statement->bindValue(2, $_titulo);

if($statement->execute() === false){
    header('Location: /index.php?sucesso=0');
} else {
    header('Location: /index.php?sucesso=2');
}
