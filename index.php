<?php
    //inclusao da __DIR__ e do json transformado em array
    include_once("config/variaveis.php");
   
    //Funcao que vai enviar dados para o JSON quando o usuario clicar no botao
    function cadastrarProduto($idProduto, $categoriaProduto, $precoProduto, $nomeProduto, $descricaoProduto, $quantidadeProduto, $imgProduto){
        //varivale que vai quardar o arquivo json
        $nomeArquivoIndex = "produtoIndex.json";
        
        if(file_exists($nomeArquivoIndex)){
           
            //variavel que vai guardar a leitura do arquivo json
            $ArquivoIndex = file_get_contents($nomeArquivoIndex);

            //transformando o arquivo json de objeto para um array
            $produtoIndex = json_decode($ArquivoIndex, true);
            
            if($produtoIndex == [] ){
                $idProduto = 0;
            }else{
                $tamanhoArray = end($produtoIndex);
                $idProduto = $tamanhoArray['idProduto'] + 1;

            }

            //adicionando produtos na array
            
            $produtoIndex[] = ["idProduto" => $idProduto, "categoria"=>$categoriaProduto, "preco"=>$precoProduto, "nome"=>$nomeProduto, "desc"=>$descricaoProduto, "quantidade"=>$quantidadeProduto, "imagemProduto"=>$imgProduto];
            //transformar novamente em objeto
           
            $json = json_encode($produtoIndex);
            

            //verificar se deu certo ou nao
            $deuCerto = file_put_contents($nomeArquivoIndex, $json);

            
            if($deuCerto){
                
                              
                header('Location:index.php');

                return "Deu certo";
                
            }else{
                return "Deu errado";
            }


        }else{
            $produtoIndex=[];
            $produtoIndex[] = ["categoria"=>$categoriaProduto, "preco"=>$precoProduto, "nome"=>$nomeProduto, "desc"=>$descricaoProduto, "quantidade"=>$quantidadeProduto, "imagemProduto"=>$imgProduto];
            $json = json_encode($produtoIndex);

            $deuCerto = file_put_contents($nomeArquivoIndex, $json);
            if($deuCerto){
                header('Location:index.php');

                return "Deu certo!";

            }else{
                return "Deu errado!";
            }
        }

    }
    
    if($_POST){
        //para tirar a imagem da pasta temporaria e incluir no meu documento.
        $nomeImg = $_FILES['imgProduto']['name'];

        $localTmp = $_FILES['imgProduto']['tmp_name'];

        $dataatual = date("d-m-y");

        $caminhoSalvo = "imagem/".$dataatual.$nomeImg;

        $deucerto = move_uploaded_file($localTmp, $caminhoSalvo);


        echo cadastrarProduto($_POST['idProduto'], $_POST['categoriaProduto'], $_POST['precoProduto'], $_POST['nomeProduto'], $_POST['descricaoProduto'], $_POST["quantidadeProduto"], $caminhoSalvo );

    }
  
    
    

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <main class="container-fluid" id="teste">
        <div class="row" id="cx-principal">
            <section class="col-6 d-flex justify-content-center" id="cx-esquerda">

                <div id="nome" class="col-4 text-center">
                    <h2 class="cor-nome-categ-preco">Nomes</h2>
                    <ul>
                        <?php if(isset($produtoIndex) && $produtoIndex != []){ ?>
                        <?php foreach($produtoIndex as $produtos){?>
                        <li class="produtos-index"><a id="links-index"
                                href="pag_produtos.php?$id=<?php echo $produtos['idProduto']?>"
                                terget="_self"><?php echo $produtos['nome'];?></a></li>
                        <?php } ?>
                        <?php }?>

                    </ul>

                </div>

                <div id="categoria" class="col-4 text-center">
                    <h2 class="cor-nome-categ-preco">Categoria</h2>
                    <ul>
                        <?php if(isset($produtoIndex) && $produtoIndex != []){ ?>
                        <?php foreach($produtoIndex as $produtos){?>

                        <li id="categ-index"><?php echo $produtos['categoria'];?></li>
                        <?php } ?>

                        <?php }?>
                    </ul>
                </div>

                <div id="preco" class="col-4 text-center">
                    <h2 class="cor-nome-categ-preco">Preços</h2>
                    <ul>
                        <?php if(isset($produtoIndex) && $produtoIndex != []){ ?>
                        <?php foreach($produtoIndex as $produtos){?>

                        <li id="preco-index"><?php echo "R$".$produtos['preco'];?></li>
                        <?php } ?>

                        <?php }?>
                    </ul>
                </div>

                <div>

                   

                </div>




            </section>

            <section class="col-6" id="cx-direita">


                <form action="" method="post" enctype="multipart/form-data" id="cx-formulario">

                    <h1>Cadastrar Produto</h1>
                    <label for="nome">Nome</label>
                    <input type="text" name="nomeProduto" id="nome" placeholder="Digite o nome do produto">
                    <label for="categoria">Categoria</label>
                    <select name="categoriaProduto" id="categoria" required>

                        <option value="">Escolha a Categoria</option>
                        <option value="Camisetas">Camisetas</option>
                        <option value="Tenis e Sapatos">Tenis e Sapatos</option>
                        <option value="Calças">Calças</option>
                        <option value="Bermudas e Shorts">Bermudas e Shorts</option>
                        <option value="Jaquetas">Jaquetas</option>
                        <option value="Regastas">Regatas</option>
                        <option value="Roupas Intimas">Roupas Intimas</option>






                    </select>
                    <label for="desc">Descrição</label>
                    <textarea name="descricaoProduto" id="desc" cols="30" rows="10" required></textarea>
                    <label for="quantidade">Quantidade</label>
                    <input type="number" name="quantidadeProduto" id="quantidade" required>
                    <label for="preco">Preco</label>
                    <input type="" name="precoProduto" id="preco" required>
                    <label for="img-p">Foto do Produto</label>
                    <input type="file" step="any" name="imgProduto" id="img-p" required>
                    <div id="cx-btn">
                        <button type="submit" id="btn-form">Enviar</button>
                    </div>

                </form>

            </section>
        </div>

    </main>

</body>

</html>