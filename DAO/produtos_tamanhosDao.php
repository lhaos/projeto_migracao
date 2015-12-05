<?php
    require_once '../persistencia/conexaoBanco.php';

    class produtos_tamanhosDao{
        private $conexao = null;

        public function __construct(){}

        public function __destruct(){
            $this->conexao = null;
        }

        public function cadastrarProdutoTamanho($pt){
            try{
                $stat = $this->conexao->prepare("insert into produtos_tamanhos(id, id_produto_cor, id_tamanho) values(?, ?, ?)");

                $stat->bindValue(1, $pt->id);
                $stat->bindValue(2, $pt->id_produto_cor);
                $stat->bindValue(3, $pt->id_tamanho);

                $stat->execute();
            }catch (Exception $e){
                echo 'Erro ao cadastrar produtos com tamanhos '.$e;
            }//fecha catch
        }//fecha cadastrarProdutoTamanho
    }//fecha classe