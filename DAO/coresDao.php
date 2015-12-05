<?php
    require_once '../persistencia/conexaoBanco.php';

    class CoresDao{

        private $conexao = null;

        public function __construct(){}

        public function __destruct(){
         $this->conexao = null;
        }

        public function cadastrarCor($c){
            try{
                $stat = $this->conexao->prepare("insert into cores(id, titulo) values(?, :?)");

                $stat->bindvalue(1, $c->id);
                $stat->bindvalue(2, $c->titulo);

                $stat->execute();
            }catch (Exception $e){
                echo 'Erro ao cadastrar cor '.$e;
            }//fecha catch
        }//fecha cadastrarCor

    }//fecha classe