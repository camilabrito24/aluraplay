<?php

namespace Alura\Mvc\Repository;
use Alura\Mvc\Entity\User;
use PDO;
class UserRepository
{

    public function __construct(private \PDO $pdo)
    {
    }

    public function findUser(string $email)
    {
        $_statement = $this->pdo->prepare('SELECT * FROM users WHERE email = ?;');
        $_statement->bindValue(1, $email);
        $_statement->execute();

        $_return = $_statement->fetch(PDO::FETCH_ASSOC);
        if(!is_array($_return)){
            return false;
        }

        return $this->hydrateUser($_return);
    }

    public function hydrateUser($data): User
    {
        $user = new User($data['email'], $data['password']);
        $user->setId($data['id']);

        return $user;
    }
}
