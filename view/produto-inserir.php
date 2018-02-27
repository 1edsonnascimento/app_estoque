<?php
$titulo = "Cadastro de produtos";
include 'cabecalho.php';?>
<h1>Cadastrar novo produto</h1>
<?php
    include '../vendor/autoload.php';
    if($_POST){
        $p = new App\Model\Produto();
        $p->setDescricao($_POST['descricao']);
        $p->setValor($_POST['valor']);
        $p->setQuantidade($_POST['quantidade']);
        $p->setValidade($_POST['validade']);

        $pd = new App\DAO\ProdutoDAO();
        if($pd->inserir($p)){
            echo "<div class='alert alert-danger'>Produto cadastrado com Sucesso!!</div>";
        }
    }
?>
<form action="produto-inserir.php" method="post">
    <div class="form-group">
        <label for="descricao"><span class="text-danger">*</span> Descrição</label>
        <input type="text" id="descricao" name="descricao" class="form-control" autofocus required>
    </div>
    <div class="form-group">
        <label for="quantidade"><span class="text-danger">*</span> Quantidade</label>
        <input type="text" id="quantidade" name="quantidade" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="valor">Valor</label>
        <input type="text" id="valor" name="valor" class="form-control">
    </div>
    <div class="form-group">
        <label for="validade">Validade</label>
        <input type="date" id="validade" name="validade" class="form-control">
    </div>
    <div class="form-group">
        Os campos com <span class="text-danger">*</span> não podem estar em branco.
    </div>
    <button type="submit" class="btn btn-success">
        <img src="../assets/images/ic_done_white_24px.svg" alt="Cadastrar o produto"> Cadastrar
    </button>
</form>
<?php include 'rodape.php';?>