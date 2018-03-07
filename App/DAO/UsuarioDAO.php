<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 26/02/2018
 * Time: 13:43
 */

namespace App\DAO;

class UsuarioDAO extends Conexao
{
    public function login($usuario){
        $sql = "select * from usuarios where email = :email and senha = :senha";
        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":email",$usuario->getEmail());
            $consulta->bindValue(":senha",\App\Helper\Senha::gerar($usuario->getSenha()));
            $consulta->execute();
            $resultado = $consulta->fetch();
            session_start();
            $_SESSION['id'] = $resultado['id'];
            return $resultado;

        }catch (\PDOException $e){
            echo "<div class='alert alert-danger'>{$e->getMessage()}</div>";
        }

    }
    public function logoff(){
        session_start();
        unset($_SESSION['id']);// destroi a variavel
        session_destroy(); //destroi a sessao
        header("Location: login.php");
    }

    public function verificar(){
        session_start();
        if(empty($_SESSION['id'])) //se a variavel de login estiver em branco vou enviar ele para a tela de login, do login
            header("Location: login.php");
    }
}