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

$dbPath = __DIR__.'/banco.sqlite';
$pdo =  new PDO("sqlite:$dbPath");
$repository = new \Alura\Mvc\Repository\VideoRepository($pdo);
$videoList = $repository->all();

require_once 'inicio_html.php';
?>
    <ul class="videos__container" alt="videos alura">
        <?php foreach ($videoList as $video) : ?>
            <?php if (!str_starts_with($video->url,'http')){
                $video['url'] = 'https://www.youtube.com/embed/tsrEYsjGoH8?si=1QEP0IGxeHb5CjrH';
            }
            ?>
        <li class="videos__item">
            <iframe width="100%" height="72%" src="<?= $video->url; ?>"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
            <div class="descricao-video">
                <img src="/img/logo.png" alt="logo canal alura">
                <h3><?= $video->title; ?></h3>
                <div class="acoes-video">
                    <a href="/editar_video?id=<?= $video->id?>">Editar</a>
                    <a href="/remover_video?id=<?= $video->id?>">Excluir</a>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>

<?php require_once 'fim_html.php'?>