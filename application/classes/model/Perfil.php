<?php

namespace app\application\classes\model;

use app\application\config\Connection;
use app\application\utils\crypt;

class Perfil
{
    private string $nome;
    private string $usuario;
    private string $email;
    private string $senha;
    private string $foto;
    private string $id;
    private $usuarioBanco;
    private Crypt $crypt;

    public function select($usuario) {
        $db = new Connection;
        $this->usuario = $usuario;
        $query = "SELECT * FROM usuarios WHERE usuario='{$this->usuario}'" ;
        $executeQuery = mysqli_query($db->connect(), $query);

        if($executeQuery) {
            return mysqli_fetch_assoc($executeQuery);
        }
        else {
            return die("Error: " . $db->connect->connect_error);
        }
    }

    public function editar() {
        $db = new Connection;
        $this->setPost($_POST);
        $this->usuarioBanco = $this->select($this->usuario);
        $this->id = $this->usuarioBanco['id'];

        if(empty($this->foto)) {
            $this->foto = $this->usuarioBanco['foto'];
        }
        else {
            $this->foto = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];
            move_uploaded_file($user_image_temp, __DIR__ . "/../../../public_html/assets/imagens/$this->foto");
        }

        if(empty($this->senha)) {
            $this->senha = $this->usuarioBanco['senha'];
        }
        else {
            $this->crypt = new Crypt;
            $this->senha = $this->crypt->encrypt($this->senha);
        }

        $query = "UPDATE usuarios SET
            nome='{$this->nome}',
            email='{$this->email}',
            senha='{$this->senha}',
            foto='{$this->foto}',
            usuario='{$this->usuario}'
            WHERE id='{$this->id}' ";

        $executeQuery = mysqli_query($db->connect(), $query);

        if($executeQuery) {
            //return mysqli_fetch_assoc($executeQuery);
            header("Location:display_perfil.php");
        }
        else {
            return die("Error: " . $db->connect->connect_error);
        }
    }

    public function login($username, $password) {
        var_dump($username);
        var_dump($password);
        $this->crypt = new Crypt;
        $this->usuarioBanco = $this->select($username);
        var_dump($this->usuarioBanco);
        if(!empty($this->usuarioBanco)) {
            if($this->crypt->verify_password($username, $password)) {
                $_SESSION['id'] = $this->usuarioBanco['id'];
                $_SESSION['usuario'] = $this->usuarioBanco['usuario'];
                $_SESSION['nome'] = $this->usuarioBanco['nome'];

                header("Location:index.php");
            }
            else {
                echo "<script>alert('Senha incorreta!')</script>";
            }
        }
        else {
            echo "<script>alert('Usuário não encontrado!')</script>";
        }
    }

    public function register() {

    }

    public function setPost($post) {
        $this->usuario = $_POST['usuario'];
        $this->email = $_POST['email'];
        $this->nome = $_POST['nome'];
        $this->senha = $_POST['senha'];
    }
}