<?php
    require_once '../persistencia/conexaoBanco.php';

    class CoresDao{

        private $conexao = null;

        public function __construct(){
            $this->conexao = conexaoBanco::getInstancia();
        }

        public function __destruct(){
         $this->conexao = null;
        }

        public function cadastrarCor($c){
            try{
                $stat = $this->conexao->prepare("insert into cores(id, titulo) values(?, ?)");

                $stat->bindvalue(1, $c->id);
                $stat->bindvalue(2, $c->titulo);

                $stat->execute();
            }catch (Exception $e){
                echo 'Erro ao cadastrar cor '.$e;
            }//fecha catch
        }//fecha cadastrarCor

        public function consultarCor($titulo){
            try{
                $stat = $this->conexao->prepare("select id from cores where titulo=?");
                $stat->bindValue(1, $titulo);

                $stat->execute();

                $retorno = $stat->fetch(PDO::FETCH_OBJ);

                return (isset($retorno->id) && $retorno->id > 0) ? $retorno->id : false;
            }catch (Exception $e){
                echo 'Erro ao consultar cor'.$e;
            }
        }//fecha consultarCor

        public function buscarUltimoId(){
            try{
                $stat = $this->conexao->prepare("select max(id) as maxid from cores");
                $stat->execute();
                $uid = $stat->fetch(PDO::FETCH_OBJ);

                return isset($uid->maxid) ? $uid->maxid : 0;

            }catch (Exception $e){
                echo 'Erro ao consultar id de cor'.$e;
            }
        }

    }//fecha classe