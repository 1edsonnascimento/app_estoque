<?php

namespace App\DAO;

class ProdutoDAO extends Conexao
{
    public function inserir($produto){
        $sql ="insert into produtos (descricao,quantidade,valor,validade) values(:descricao,:quantidade,:valor,:validade)";
        try{
            $i = $this->conexao->prepare($sql);
            $i->bindValue(":descricao",$produto->getDescricao());
            $i->bindValue(":quantidade",$produto->getQuantidade());
            $i->bindValue(":valor",$produto->getValor());
            $i->bindValue(":validade",$produto->getValidade());
            $i->execute();
            return true;
        }catch (\PDOException $e){
            echo "<div class='alert alert-danger'>{$e->getMessage()}</div>";
            return false;
        }
    }

    public function pesquisar($produto = null){
        $sql = "select * from produtos where descricao like :descricao";
        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":descricao","%".$produto->getDescricao()."%");
            $consulta->execute();
            return $consulta->fetchAll(\PDO::FETCH_CLASS,"App\Model\Produto");
        }catch (\PDOException $e){
            echo "<div class='alert alert-danger'>Erro: {$e->getMessage()}</div>";
        }
    }

    public function excluir($produto){
        $sql ="delete from produtos where id = :id";
        try{
            $i = $this->conexao->prepare($sql);
            $i->bindValue(":id",$produto->getId());
            $i->execute();
            return true;
        }catch (\PDOException $e){
            echo "<div class='alert alert-danger'>{$e->getMessage()}</div>";
            return false;
        }
    }


    public function pesquisarUnico($produto){
        $sql = "select * from produtos where id = :id";
        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id",$produto->getId());
            $consulta->execute();
            return $consulta->fetch(\PDO::FETCH_ASSOC);
        }catch (\PDOException $e){
            echo "<div class='alert alert-danger'>Erro: {$e->getMessage()}</div>";
        }
    }

    public function alterar($produto){
        $sql = "update produtos set descricao= :descricao, quantidade = :qtd, valor = :valor, validade = :validade where id = :id";
        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":descricao",$produto->getDescricao());
            $consulta->bindValue(":qtd",$produto->getQuantidade());
            $consulta->bindValue(":valor",$produto->getValor());
            $consulta->bindValue(":validade",$produto->getValidade());
            $consulta->bindValue(":id",$produto->getId());
            $consulta->execute();
            return true;
        }catch (\PDOException $e){
            echo "<div class='alert alert-danger'>Erro: {$e->getMessage()}</div>";
        }
    }
}