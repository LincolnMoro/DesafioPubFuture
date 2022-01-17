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

    //Seleciona o usuário para exibição
    public function select($id) {
        $db = new Connection;
        $this->id = $id;
        $query = "SELECT * FROM usuarios WHERE id='{$this->id}'" ;
        $executeQuery = mysqli_query($db->connect(), $query);

        if($executeQuery) {
            return mysqli_fetch_assoc($executeQuery);
        }
        else {
            return die("Error: " . $db->connect->connect_error);
        }
    }

    //Responsável por gravar os dados da edição do usuário no banco de dados
    public function editar($usuarioSessao) {
        $db = new Connection;
        $this->setPost($_POST);
        $this->usuarioBanco = $this->select($usuarioSessao);

        //Identifica se houve alteração ou não na foto do usuário
        if(empty($this->foto)) {
            $this->foto = $this->usuarioBanco['foto'];
        }
        //Trata a foto para guardar no banco de dados
        else {
            $this->foto = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];
            move_uploaded_file($user_image_temp, __DIR__ . "/../../../public_html/assets/imagens/$this->foto");
        }

        //Identifica se houve alteração ou não na senha do usuário
        if(empty($this->senha)) {
            $this->senha = $this->usuarioBanco['senha'];
        }
        //Realiza a alteração da senha do usuáruio
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
            WHERE id='{$usuarioSessao}' ";

        $executeQuery = mysqli_query($db->connect(), $query);

        if($executeQuery) {
            //return mysqli_fetch_assoc($executeQuery);
            $_SESSION['usuario'] = $this->usuario;
            //header("Location:display_perfil.php");
        }
        else {
            return die("Error: " . $db->connect->connect_error);
        }
    }

    //Responsável por efetuar o login do usuário
    public function login($username, $password) {
        $this->crypt = new Crypt;
        $this->usuarioBanco = $this->selectLogin($username);
        if(!empty($this->usuarioBanco)) {
            if($this->crypt->verify_password($username, $password)) {
                //Inicia a sessão do usuário
                $_SESSION['id'] = $this->usuarioBanco['id'];
                $_SESSION['usuario'] = $this->usuarioBanco['usuario'];
                $_SESSION['nome'] = $this->usuarioBanco['nome'];
                $_SESSION['active'] = true;

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

    //Em desemvolvimento
    public function register() {

    }

    //Grava os dados da variável POST nos atributos da classe
    public function setPost($post) {
        $this->usuario = $_POST['usuario'];
        $this->email = $_POST['email'];
        $this->nome = $_POST['nome'];
        $this->senha = $_POST['senha'];
    }

    //Lista possíveis usuários com base na tela de login
    public function selectLogin($usuario) {
        $db = new Connection;
        $query = "SELECT * FROM usuarios WHERE usuario='{$usuario}'" ;
        $executeQuery = mysqli_query($db->connect(), $query);

        if($executeQuery) {
            return mysqli_fetch_assoc($executeQuery);
        }
        else {
            return die("Error: " . $db->connect->connect_error);
        }
    }
}