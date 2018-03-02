<?php
$titulo = "Alteração de produtos";
include 'cabecalho.php';?>
<h1>Alterar produto</h1>
<?php
include '../vendor/autoload.php';
$p = new App\Model\Produto();
$p->setId($_GET['id']);

$pDao = new App\DAO\ProdutoDAO();
$produto = $pDao->pesquisarUnico($p);

?>
    <form action="produto-alterar.php" method="post">
        <div class="form-group">
            <label for="id">ID</label>
            <input type="text" id="id" name="id" value="<?php echo $produto->getId(); ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="descricao"><span class="text-danger">*</span> Descrição</label>
            <input type="text" id="descricao" name="descricao" value=<?php echo $produto->getDescricao(); ?>required autofocus class="form-control">
        </div>
        <div class="form-group">
            <label for="quantidade"><span class="text-danger">*</span> Quantidade</label>
            <input type="text" id="quantidade" name="quantidade" value=<?php echo \App\Helper\Moeda::set($produto->getQuantidade()); ?> required class="form-control">
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="text" id="valor" name="valor" value=<?php echo \App\Helper\Moeda::set($produto->getValor()); ?> class="form-control">
        </div>
        <div class="form-group">
            <label for="validade">Validade</label>
            <input type="date" id="validade" name="validade" value=<?php  echo \App\Helper\Data::set($produto->getValidade()); ?> class="form-control">
        </div>
        <div class="form-group">
            Os campos com <span class="text-danger">*</span> não podem estar em branco.
        </div>
        <button type="submit" class="btn btn-success">
            <img src="../assets/images/ic_done_white_24px.svg" alt="Alterar o produto"> Alterar
        </button>
    </form>
<?php include 'rodape.php';?>