<?php
    require_once '../persistencia/conexaoBanco.php';
    include_once '../modelo/dados_antigos.class.php';
    class Dados_antigosDao{

        private $conexao = null;

        public function __construct(){
            $this->conexao = conexaoBanco::getInstancia();
        }

        public function __destruct(){
            $this->conexao = null;
        }

        public function buscarProdutos(){
            try{
                $stat = $this->conexao->query("select * from dados_antigos");
                $array = $stat->fetchAll(PDO::FETCH_OBJ);

                return $array;
            }catch (Exception $e){
                echo 'Erro ao buscar '.$e;
            }//fecha catch

        }//fecha buscarProdutos
    }//fecha classe