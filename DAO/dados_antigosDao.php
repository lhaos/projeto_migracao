<?php
    require_once '../persistencia/conexaoBanco.php';
    class dados_antigosDao{

        private $conexao = null;

        public function __construct(){
            $this->conexao = conexaoBanco::getInstancia();
        }

        public function __destruct(){
            $this->conexao = null;
        }

        public function buscarProdutos(){
            try{
                $stat = $this->conexao->query("select codigo, titulo, cor, tamanho from dados_antigos");
                $array = $stat->fetchAll(PDO::FETCH_CLASS, 'dados_antigos');

                return $array;
            }catch (Exception $e){
                echo 'Erro ao buscar '.$e;
            }//fecha catch

        }//fecha buscarProdutos
    }//fecha classe