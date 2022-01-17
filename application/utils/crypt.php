<?php

namespace app\application\utils;

use app\application\classes\model\Perfil;

class crypt
{
    private string $pepper = "$2y$10$5f43y8a6e4ghlvmyia12di";
    private string $userPass;
    private string $passPeppered;
    private string $passHashed;
    private Perfil $user;

    //Verifica a igualdade das senhas no momento do login
    public function verify_password($usuario, $userPass) {
        $this->user = new Perfil;
        $this->userPass = $userPass;
        $dbUser = $this->user->selectLogin($usuario);
        $this->passHashed = $dbUser['senha'];
        $this->passPeppered = hash_hmac("sha256", $this->userPass, $this->pepper);
        if($this->passPeppered = password_verify($this->passPeppered, $this->passHashed)) {
            return true;
        }
        else {
            return false;
        }
    }

    //Criptografa a senha do usuário
    public function encrypt($userPass) {
        $this->userPass = $userPass;
        $this->passPeppered = hash_hmac("sha256", $this->userPass, $this->pepper);
        $this->passHashed = password_hash($this->passPeppered, PASSWORD_ARGON2ID);
        return $this->passHashed;
    }
}