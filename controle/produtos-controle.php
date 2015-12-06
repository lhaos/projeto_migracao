<?php
    ini_set('display_errors', true);
    error_reporting(E_ALL);
    require_once '../modelo/produtos.class.php';
    require_once '../modelo/cores.class.php';
    require_once '../modelo/produtos_cores.class.php';
    require_once '../modelo/produtos_tamanhos.class.php';
    require_once '../modelo/tamanhos.class.php';
    require_once '../DAO/tamanhosDao.php';
    require_once '../DAO/produtos_coresDao.php';
    require_once '../DAO/produtos_tamanhosDao.php';
    require_once '../DAO/produtosDao.php';
    require_once '../DAO/dados_antigosDao.php';
    require_once '../DAO/coresDao.php';

    //variaveis que recebem os produtos originais
    $da = new Dados_antigosDao();
    $array = $da->buscarProdutos();

    //varivaies cores
    $cdao = new CoresDao();
    $cores = new Cores();

    //variaveis de produtos
    $pdao = new ProdutosDao();
    $produtos = new Produtos();

    //variaveis para os tamanhos
    $tdao = new TamanhosDao();
    $tamanhos = new Tamanhos();

    //variaveis para produtos_cores
    $pcdao = new Produtos_coresDao();
    $pc = new Pc();

    //variaveis para produtos_tamanhos
    $ptdao = new Produtos_tamanhosDao();
    $pt = new Pt();

    //variaveis auxiliares
    $aux = $auxCor = $auxTamanho = null;

    foreach($array as $a){
        //if para fazer a verificação e cadastro dos produtos
        if($aux != $a->codigo){
            $aux = $a->codigo;
            echo 'iniciando o produto '.$a->titulo.' com o codigo '.$a->codigo.'<br>';

            $idProduto = $pdao->consultarProduto($a->codigo);


            if(!$idProduto){

                $produtos->id = $pdao->buscarUltimoId() + 1;
                $produtos->titulo = $a->titulo;
                $produtos->codigo = $a->codigo;

                $pdao->cadastrarProduto($produtos);
                $idProduto = $produtos->id;
                echo 'inserindo o produto '.$a->titulo.' com o codigo '.$a->codigo.'<br>';
            }

        }//fim do if para os produtos

        //if para fazer a verificação e cadastro das cores
       if($auxCor != $a->cor){
           $auxCor = $a->cor;
           echo 'iniciando a cor '.$a->cor.'<br>';
           $idCor = $cdao->consultarCor($a->cor);

           if(!$idCor){

                $cores->id = $cdao->buscarUltimoId() + 1;
                $cores->titulo = $a->cor;

               $cdao->cadastrarCor($cores);
               $idCor = $cores->id;
               echo 'inserindo a cor '.$a->cor.'<br>';
           }

       }//fim do if para as cores

        //if para fazer a verificação e cadastro dos tamanhos
        if($auxTamanho != $a->tamanho){
            $auxTamanho = $a->tamanho;
            echo 'iniciando o tamanho '.$a->tamanho.'<br>';
            $idTamanho = $tdao->consultarTamanhos($a->tamanho);

            if(!$idTamanho){

                $tamanhos->id = $tdao->buscarUltimoId() + 1;
                $tamanhos->titulo = $a->tamanho;
                $tdao->cadastrarTamanho($tamanhos);
                $idTamanho = $tamanhos->id;
                echo 'inserindo o tamanho '.$a->tamanho.'<br>';
            }

        }//fim do if para os tamanhos

        //if para produtos_cores
        $idpc = $pcdao->consultarIdPC($idCor, $idProduto);
        echo 'consuntando o vinculo produto cor '.$idpc.'<br>';
        if(!$idpc){

            $pc->id = $pcdao->buscarUltimoId() + 1;
            $pc->id_cor = $idCor;
            $pc->id_produto = $idProduto;

            $pcdao->cadastrarProdutoCor($pc);
            $idpc = $pc->id;
            echo 'inserindo o vinculo produto cor '.$idpc.'<br>';
        }
        //fim do if para produtos_cores

        //if para os produtos_tamanhos
        $idpt = $ptdao->consultarIdPT($idpc, $idTamanho);
        echo 'consuntando o vinculo produto tamanho '.$idpt.'<br>';
        if(!$idpt){

            $pt->id = $ptdao->buscarUltimoId() + 1;
            $pt->id_produto_cor = $idpc;
            $pt->id_tamanho = $idTamanho;

            $ptdao->cadastrarProdutoTamanho($pt);
            $idtp = $pt->id;
            echo 'inserindo o vinculo produto tamanho '.$idpt.'<br>';
        }
        //fim do if para produtos_tamanhos
    }//fecha foreach