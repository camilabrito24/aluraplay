<?php

$_caminho = __DIR__.'/banco.sqlite';
$pdo =  new PDO("sqlite:$_caminho");

$_id = $_GET['id'];
$_sql = 'DELETE FROM videos WHERE id = ?';
$_statement = $pdo->prepare($_sql);
$_statement->bindValue(1, $_id);

if($_statement->execute() === false){
    header('Location: /?sucesso=0');
} else {
    header('Location: /?sucesso=1');
}