<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Entity\Video;

class NewVideoController
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $url = filter_input(INPUT_POST,'url',FILTER_VALIDATE_URL);
        $title = filter_input(INPUT_POST,'titulo');

        if($url === false || $title === false) {
            header('Location: /?sucesso=0');
            return;
        }

        $result = $this->videoRepository->add(new Video($url,$title));

        if($result === false){
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=2');
        }

    }
}