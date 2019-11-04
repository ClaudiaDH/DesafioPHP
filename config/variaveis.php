<?php

    $nomeArquivoIndex = __DIR__."/../produtoIndex.json";
    

    //abrir o arquivo
    //maneira mais resumida
    //transformar em uma array
    //$arquivo = file_get_contents($nomeArquivo);
    //$produtos = json_decode($arquivo,true);
    $produtoIndex = json_decode(file_get_contents($nomeArquivoIndex), true);

    



?>