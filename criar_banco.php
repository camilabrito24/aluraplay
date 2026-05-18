<?php

$_caminho = __DIR__.'/banco.sqlite';
$pdo =  new PDO("sqlite:$_caminho");
$pdo->exec("CREATE TABLE IF NOT EXISTS videos (id INTEGER PRIMARY KEY, url TEXT, title TEXT)");