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

    public function verify_password($userPass, $usuario) {
        $this->user = new Perfil;
        $this->userPass = $userPass;
        $this->passHashed = $this->user->select($usuario);
        $this->passPeppered = hash_hmac("sha256", $this->userPass, $this->pepper);
        if(password_verify($this->passHashed, $this->passPeppered)) {
            return true;
        }
        else {
            return false;
        }
    }

    public function encrypt($userPass) {
        $this->userPass = $userPass;
        $this->passPeppered = hash_hmac("sha256", $this->userPass, $this->pepper);
        $this->passHashed = password_hash($this->passPeppered, PASSWORD_ARGON2ID);
        return $this->passHashed;
    }
}