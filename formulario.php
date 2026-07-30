<?php
$_caminho = __DIR__.'/banco.sqlite';
$pdo =  new PDO("sqlite:$_caminho");

$_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$_video =
    [
        'url' => '',
        'title' => ''
    ];

if($_id !== false && $_id !== null){
    $_statement = $pdo->prepare('SELECT * FROM videos WHERE id = ?;');
    $_statement->bindValue(1, $_id, PDO::PARAM_INT);
    $_statement->execute();
    $_video = $_statement->fetch(PDO::FETCH_ASSOC);
}

require_once 'inicio_html.php';
?>
    <main class="container">

        <form class="container__formulario" method="post">
            <h2 class="formulario__titulo">Envie um vídeo!</h2>
                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="url">Link embed</label>
                    <input name="url" value="<?= $_video['url']; ?>" class="campo__escrita" required
                        placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" id='url' />
                </div>


                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                    <input name="titulo" value="<?= $_video['title']; ?>"class="campo__escrita" required placeholder="Neste campo, dê o nome do vídeo"
                        id='titulo' />
                </div>

                <input class="formulario__botao" type="submit" value="Enviar" />
        </form>

    </main>
<?php require_once 'fim_html.php'?>