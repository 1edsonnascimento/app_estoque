<?php

include '../vendor/autoload.php';




//alterei aqui
$uDao = new \App\DAO\UsuarioDAO();
$uDao->verificar();





$p = new App\Model\Produto();
$p->setId($_GET['id']);

$pDao = new App\DAO\ProdutoDAO();
if($pDao->excluir($p))
    header("Location:produto-pesquisar.php?msg=1");