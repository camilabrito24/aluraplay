<?php if (isset($_GET['sucesso'])): ?>
    <script>
        const status = "<?php echo $_GET['sucesso']; ?>";
        if (status === "1") {
            alert("🗑️ Vídeo removido com sucesso!");
        } else if (status === "2"){
            alert("✅ Vídeo cadastrado com sucesso!");
        } else if (status === "3"){
            alert("🔃 Vídeo atualizado com sucesso!");
        } else {
            alert("❌ Ops! Algo deu errado na operação.");
        }

        // Limpa a URL para o alerta não repetir ao dar F5
        window.history.replaceState(null, null, window.location.pathname);
    </script>
<?php endif; ?>
<?php

$_caminho = __DIR__.'/banco.sqlite';
$pdo =  new PDO("sqlite:$_caminho");
$_listaVideo = $pdo->query('SELECT * FROM videos;')->fetchAll(PDO::FETCH_ASSOC);

?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/flexbox.css">
    <title>AluraPlay</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
</head>

<body>

    <header>

        <nav class="cabecalho">
            <a class="logo" href="index.php"></a>

            <div class="cabecalho__icones">
                <a href="./pages/enviar-video.html" class="cabecalho__videos"></a>
                <a href="./pages/login.html" class="cabecalho__sair">Sair</a>
            </div>
        </nav>

    </header>

    <ul class="videos__container" alt="videos alura">
        <?php foreach ($_listaVideo as $_video) : ?>
            <?php if (!str_starts_with($_video['url'],'http')){
                $_video['url'] = 'https://www.youtube.com/embed/tsrEYsjGoH8?si=1QEP0IGxeHb5CjrH';
            }
            ?>
        <li class="videos__item">
            <iframe width="100%" height="72%" src="<?= $_video['url']; ?>"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
            <div class="descricao-video">
                <img src="./img/logo.png" alt="logo canal alura">
                <h3><?= $_video['title']; ?></h3>
                <div class="acoes-video">
                    <a href="./formulario.php?id=<?= $_video['id']?>">Editar</a>
                    <a href="./remover_video.php?id=<?= $_video['id']?>">Excluir</a>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>