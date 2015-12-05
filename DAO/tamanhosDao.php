<?php
    require_once '../persistencia/conexaoBanco.php';

    class TamanhosDao{
        private $conexao = null;

        public function __construct(){}

        public function __destruct(){
            $this->conexao = null;
        }

        public function cadastrarTamanho($t){
            try{
                $stat = $this->conexao->prepare("insert into tamanhos(id, titulo) values(?, ?)");

                $stat->bindValue(1, $t->id);
                $stat->bindValue(2, $t->titulo);

                $stat->execute();
            }catch (Exception $e){
                echo 'Erro ao cadastrar tamanho '.$e;
            }//fecha catch
        }//fecha cadastrarTamanho

    }//fecha classe