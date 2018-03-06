<?php
$titulo = "Pesquisa de produtos";
include 'cabecalho.php';?>
<h1>Pesquisar produtos</h1>
<br>
<form class="form-inline" action="produto-pesquisar.php" method="get">
    <div class="form-group">
        <label for="descricao">Descrição: </label>
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Ex.: Sabão em pó" autofocus>
    </div>
    <button type="submit" class="btn btn-primary mb-2">
        <img src="../assets/images/ic_search_white_24px.svg" alt="Pesquisar">
        Pesquisar
    </button>
</form>
<?php
include '../vendor/autoload.php';

if($_GET['msg'] && $_GET['msg'] ==1 )
    echo "<div class='alert alert-success'>Produto excluido com sucesso!!</div>";
if($_GET['msg'] && $_GET['msg'] == 2 )
    echo "<div class='alert alert-success'>Alteração feita com sucesso!!</div>";
$p = new \App\Model\Produto();
isset($_GET['descricao'])? $p->setDescricao($_GET['descricao']): $p->setDescricao("");
$pDao = new App\DAO\ProdutoDAO();
$produtos = $pDao->pesquisar($p);  //os produtos sao retornados do tipo de uma classe la na pesquisa por isso eles podem ser acessados agora

 if(count($produtos) > 0){ ?>
    <table class='table table-striped table-hover'>
        <tr>
            <th>ID</th>
            <th class='text-left'>Descrição</th>
            <th>Quantidade</th>
            <th>Valor</th>
            <th>Validade</th>
            <th></th>
            <th></th>

        </tr>
       <?php
       foreach ($produtos as $itens){
           echo "<tr class='text-center'>";
           echo "<td>{$itens->getId()}</td>";
           echo "<td class='text-left'>{$itens->getDescricao()}</td>";
           echo "<td>".\App\Helper\Moeda::get($itens->getQuantidade())."</td>";
           echo "<td>".\App\Helper\Moeda::get($itens->getValor())."</td>";
           echo "<td>".\App\Helper\Data::get($itens->getValidade())."</td>";
           echo "<td><a class='btn btn-danger' href='produto-excluir.php?id={$itens->getId()}'>Excluir</a></td>";
           echo "<td><a class='btn btn-warning' href='produto-alterar.php?id={$itens->getId()}'>Alterar</a></td>";
           echo "<tr>";
       }
       ?>

    </table>


<?php }else{
        echo "<div class='alert alert-danger'>Nenhum produto encontrado</div>";
    }

include 'rodape.php';

    ?>