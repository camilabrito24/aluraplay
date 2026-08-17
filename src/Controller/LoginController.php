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

        if($correctPassword){
            header("Location: /");
        } else {
            header('Location: login?sucesso=0');
        }
    }
}