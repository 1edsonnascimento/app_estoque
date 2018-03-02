<?php

include '../vendor/autoload.php';
$p = new App\Model\Produto();
$p->setId($_GET['id']);

$pDao = new App\DAO\ProdutoDAO();
if($pDao->excluir($p))
    header("Location:produto-pesquisar.php?msg=1");