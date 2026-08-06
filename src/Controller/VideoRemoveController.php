<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class VideoRemoveController
{

    public function __construct(private VideoRepository $repository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if($id === null || $id === false){
            header('Location: /?sucesso=0');
            return;
        }

        $result = $this->repository->remove($id);

        if($result === false){
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }
}