<?php
    require_once '../persistencia/conexaoBanco.php';

    class TamanhosDao{
        private $conexao = null;

        public function __construct(){
            $this->conexao = conexaoBanco::getInstancia();
        }

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

        public function consultarTamanhos($titulo){
            try{
                $stat = $this->conexao->prepare("select id from tamanhos where titulo=?");
                $stat->bindValue(1, $titulo);

                $stat->execute();

                $retorno = $stat->fetch(PDO::FETCH_OBJ);

                return (isset($retorno->id) && $retorno->id > 0) ? $retorno->id : false;
            }catch (Exception $e){
                echo 'Erro ao consultar produto'.$e;
            }
        }//fecha consultarTamanhos

        public function buscarUltimoId(){
            try{
                $stat = $this->conexao->prepare("select max(id) as maxid from tamanhos");
                $stat->execute();
                $uid = $stat->fetch(PDO::FETCH_OBJ);
                return isset($uid->maxid) ? $uid->maxid : 0;

            }catch (Exception $e){
                echo 'Erro ao consultar id do tamanho'.$e;
            }
        }//fecha buscarid

    }//fecha classe