<?php
    require_once '../persistencia/conexaoBanco.php';

    class Produtos_coresDao{
        private $conexao = null;

        public function __construct(){}

        public function __destruct(){
            $this->conexao = null;
        }

        public function cadastrarProdutoCor($pc){
            try{
                $stat = $this->conexao->prepare("insert into produtos_cores(id, id_cor, id_produto) values(?, ?, ?)");

                $stat->bindValue(1, $pc->id);
                $stat->bindValue(2, $pc->id_cor);
                $stat->bindValue(3, $pc->id_produto);

                $stat->execute();
            }catch (Exception $e){
                echo 'Erro ao cadastrar produtos com cores'.$e;
            }//fecha catch
        }//fecha cadastrarProdutoCor

    }//fecha classe