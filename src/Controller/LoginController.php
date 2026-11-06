<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\UserRepository;

class LoginController implements Controller
{

    public function __construct(private UserRepository $userRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');


        $userData = $this->userRepository->findUser($email);
        $userPassword = $userData->password ?? '';
        $correctPassword = password_verify($password, $userPassword);

        if(password_needs_rehash($userPassword, PASSWORD_ARGON2ID)){
            $statement = $this->pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
            $statement->bindValue(':password', password_hash($password, PASSWORD_ARGON2ID));
            $statement->bindValue(':id', $userData->id);
            $statement->execute();
        }

        if($correctPassword){
            $_SESSION['logado'] = true;
            header("Location: /");
        } else {
            header('Location: login?sucesso=0');
        }
    }
}