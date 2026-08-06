<?php

namespace Alura\Mvc\Repository;

use Alura\Mvc\Entity\Video;
use PDO;

class VideoRepository
{
    public function __construct(private \PDO $pdo)
    {

    }

    public function add(Video $video): bool
    {
        $sql = "INSERT INTO videos (url, title) VALUES(?, ?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $video->url);
        $statement->bindValue(2, $video->title);

        $result =  $statement->execute();

        $id = $this->pdo->lastInsertId();
        $video->setId(intval($id));

        return $result;

    }

    public function remove(int $id) : bool
    {
        $_sql = 'DELETE FROM videos WHERE id = ?';
        $_statement = $this->pdo->prepare($_sql);
        $_statement->bindValue(1, $id);

        return $_statement->execute();
    }

    public function update(Video $video) : bool
    {
        $_sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id;';
        $_statement = $this->pdo->prepare($_sql);
        $_statement->bindValue(':url', $video->url);
        $_statement->bindValue(':title', $video->title);
        $_statement->bindValue(':id', $video->id, \PDO::PARAM_INT);

        return $_statement->execute();
    }

    public function all():array
    {
        $videoList = $this->pdo->query('SELECT * FROM videos;')->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(
            $this->hydrateVideo(...),
            $videoList
        );
    }

    public function find(int $id)
    {
        $_statement = $this->pdo->prepare('SELECT * FROM videos WHERE id = ?;');
        $_statement->bindValue(1, $id, PDO::PARAM_INT);
        $_statement->execute();

        return $this->hydrateVideo($_statement->fetch(PDO::FETCH_ASSOC));
    }

    public function hydrateVideo(array $videoData): Video
    {
        $video = new Video($videoData['url'], $videoData['title']);
        $video->setId($videoData['id']);

        return $video;
    }
}