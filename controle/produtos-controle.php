<?php
    ini_set('display_errors', true);
    error_reporting(E_ALL);
    require_once '../modelo/produtos.class.php';
    require_once '../DAO/produtosDao.php';
    require_once '../DAO/dados_antigosDao.php';

    $da = new Dados_antigosDao();
    $array = $da->buscarProdutos();

    foreach($array as $a){
        echo $a['codigo']." - ".$a['titulo']." - ".$a['cor']." - ".$a['tamanho']."<br>";
    }
/*
    if($array != null){
        $p = new Produtos();

        $p->id = null;
        $p->titulo = $da->titulo;
        $p->codigo = $da->codigo;

        $pdao = new ProdutosDao();
        $pdao->cadastrarProduto($p);
    }else{
        echo 'Erro';
    }//fecha else*/