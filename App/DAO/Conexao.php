<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 26/02/2018
 * Time: 13:43
 */

namespace App\DAO;


class Conexao
{
    protected $conexao;
    private $database = "db_estoque";
    private $host = "localhost";
    private $user = "root";
    private $senha = "Suporte99";

    public function __construct()
    {
        $this->conexao = new \PDO("mysql:host={$this->host};dbname={$this->database}",$this->user,$this->senha);
        $this->conexao->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
    }
}