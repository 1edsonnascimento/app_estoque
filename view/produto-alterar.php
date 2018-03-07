<?php
$titulo = "Alteração de produtos";
include 'cabecalho.php';?>
<h1>Alterar produto</h1>
<?php
include '../vendor/autoload.php';


//alterei aqui
$uDao = new \App\DAO\UsuarioDAO();
$uDao->verificar();



if($_POST){
    $p2 = new \App\Model\Produto();
    $p2->setId($_POST['id']);
    $p2->setDescricao($_POST['descricao']);
    $p2->setQuantidade(\App\Helper\Moeda::set($_POST['quantidade']));
    isset($_POST['valor'])? $p2->setValor(\App\Helper\Moeda::set($_POST['valor'])): $p2->setValor(null);
    isset($_POST['validade'])? $p2->setValidade(\App\Helper\Data::set($_POST['validade'])): $p2->setValidade(null);

    $p2Dao = new \App\DAO\ProdutoDAO();
    if($p2Dao->alterar($p2))
        header("Location: produto-pesquisar.php?msg=2");
}

$p = new \App\Model\Produto();
isset($_GET)? $p->setId($_GET['id']):$p->setId($_POST['id']);

$pDao = new \App\DAO\ProdutoDAO();
$produto = $pDao->pesquisarUnico($p);

?>
    <form action="produto-alterar.php" method="post">
        <div class="form-group">
            <label for="id">ID</label>
            <input type="text" id="id" name="id" value="<?php echo $produto['id']; ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="descricao"><span class="text-danger">*</span> Descrição</label>
            <input type="text" id="descricao" name="descricao" value="<?php echo $produto['descricao']; ?>" required autofocus class="form-control">
        </div>
        <div class="form-group">
            <label for="quantidade"><span class="text-danger">*</span> Quantidade</label>
            <input type="text" id="quantidade" name="quantidade" value="<?php echo \App\Helper\Moeda::get($produto['quantidade']); ?>" required class="form-control">
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="text" id="valor" name="valor" value="<?php echo \App\Helper\Moeda::get($produto['valor']) ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="validade">Validade</label>
            <input type="date" id="validade" name="validade" value="<?php  echo $produto['validade']; ?>" class="form-control">
        </div>
        <div class="form-group">
            Os campos com <span class="text-danger">*</span> não podem estar em branco.
        </div>
        <button type="submit" class="btn btn-success">
            <img src="../assets/images/ic_done_white_24px.svg" alt="Alterar o produto"> Alterar
        </button>
    </form>
<?php include 'rodape.php';?>