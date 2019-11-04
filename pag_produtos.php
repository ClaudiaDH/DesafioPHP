
<?php include_once("config/variaveis.php")?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagina de Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <main class="container" id="cx-main">

        <a href="index.php" id="btn-voltar"> Voltar para lista de produtos</a>

        <div class="row " id="cx-principal-produtos">

            <div class="col-5 d-flex justify-content-center align-items-center" id="cx-produtos-img">
                <div id="img-produto">
                    <?php if(isset($produtoIndex) && $produtoIndex != []){?>
                    <?php foreach ($produtoIndex as $produtos) { ?>
                    <?php foreach ($_GET as $key => $value) { ?>

                    <?php if($value == $produtos['idProduto'] && $produtos['idProduto'] != []){ ?>
                        <img  src="<?php echo $produtos["imagemProduto"]; ?>" alt="" width="300" height="300">

                    <?php } ?>

                    <?php } ?>

                    <?php } ?>
                    <?php }else{ ?>
                    echo "nao deu";
                    <?php } ?>

                </div>


            </div>

            <div class="col-7" id="cx-produtos-info">

                <?php if(isset($produtoIndex) && $produtoIndex != []){?>
                <?php foreach ($produtoIndex as $produtos) { ?>
                <?php foreach ($_GET as $key => $value) { ?>

                <?php if($value == $produtos['idProduto'] && $produtos['idProduto'] != []){ ?>
                <!--echo $produtos['nome'];-->
                <!--echo $value.$produtos['idProduto'];-->
                <h1><?php echo $produtos['nome'];?></h1>
                <h3 class="sub-produtos">Categoria</h3>
                <h2 class="desc"><?php echo $produtos['categoria'];?></h2>
                <h3 class="sub-produtos">Descrição</h3>
                <h2 class="desc"><?php echo $produtos['desc'];?></h2>
                <div id="tabela" class="d-flex align-items-end">
                <table>
                    <tr>
                        <th>Quantidade em Estoque</th>
                        <th>Preço</th>
                    </tr>
                    <td><?php echo $produtos['quantidade']; ?></td>
                    <td><?php echo $produtos['preco']; ?></td>
                </table>
                </div>

                <?php } ?>

                <?php } ?>

                <?php } ?>
                <?php }else{ ?>
                echo "nao deu";
                <?php } ?>




            </div>

        </div>



    </main>



</body>

</html>