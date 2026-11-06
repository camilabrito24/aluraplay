<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Entity\Video;
use finfo;

readonly class NewVideoController implements Controller
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

        $video = new Video($url,$title);
        if($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $safeFileName = uniqid('UPLOAD_') . '_' . pathinfo($_FILES['image']['tmp_name'], PATHINFO_BASENAME);
            $fileInfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $fileInfo->file($_FILES['image']['tmp_name']);

            if(str_starts_with($mimeType, 'image/')) {
                move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    __DIR__ . '/../../public/img/uploads/'. $safeFileName
                );
                $video->setFilePath($safeFileName);
            }
        }

        $result = $this->videoRepository->add($video);

        if($result === false){
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=2');
        }

    }
}