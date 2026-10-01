<?php

namespace Alura\Mvc\Controller;

class LoginFormController implements Controller
{

    public function processaRequisicao():void
    {
        if($_SESSION['logado'] === true) {
            header('Location: /');
        }

        require_once __DIR__ . "/../../templates/login-form.php";
    }
}