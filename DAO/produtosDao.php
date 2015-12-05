<?php
    require_once '../persistencia/conexaoBanco.php';

    class ProdutosDao{

        private $conexao = null;

        public function __construct(){}

        public function __destruct(){
            $this->conexao = null;
        }

        public function cadastrarProduto($p){
            try{
                $stat = $this->conexao->prepare("insert into produtos(id, titulo, codigo) values(?, ?, ?)");

                $stat->bindValue(1, $p->id);
                $stat->bindValue(2, $p->titulo);
                $stat->bindValue(3, $p->codigo);

                $stat->execute();
            }catch (Exception $e){
                echo 'Erro ao cadastrar produto'.$e;
            }//fecha catch
        }//fecha cadastrarProduto

    }//fecha classe