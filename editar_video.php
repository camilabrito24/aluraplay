<?php

$_caminho = __DIR__.'/banco.sqlite';
$pdo =  new PDO("sqlite:$_caminho");

$_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($_id === false){
    header('Location: /?sucesso=0');
    exit();
}

$_url = filter_input(INPUT_POST,'url',FILTER_VALIDATE_URL);
$_titulo = filter_input(INPUT_POST,'titulo');

if($_url === false || $_titulo === false) {
    header('Location: /?sucesso=0');
    exit();
}

$_sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id;';
$_statement = $pdo->prepare($_sql);
$_statement->bindValue(':url', $_url);
$_statement->bindValue(':title', $_titulo);
$_statement->bindValue(':id', $_id, PDO::PARAM_INT);

if($_statement->execute() === false){
    header('Location: /?sucesso=0');
} else {
    header('Location: /?sucesso=3');
}