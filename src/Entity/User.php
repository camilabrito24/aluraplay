<?php

namespace Alura\Mvc\Entity;

class User
{

    public readonly string $email;
    public readonly int $id;
    public readonly string $password;

    public function __construct(string $email, string $password)
    {
        $this->setEmail($email);
        $this->password = $password;
    }

    public function setEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            throw new \Exception("Email invalido");
        }

        $this->email = $email;

    }

    public function setId($id) : void
    {
        $this->id = $id;
    }
}